<?php

namespace App\Services;

use App\Contracts\ShouldBeStored;
use App\StoredJob;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer as SymfonySerializer;

class Dispatcher extends \Illuminate\Bus\Dispatcher
{
    public function dispatchNow($command, $handler = null)
    {
        if ($handler || $handler = $this->getCommandHandler($command)) {
            $callback = function ($command) use ($handler) {
                return $handler->handle($command);
            };
        } else {
            $callback = function ($command) {
                return $this->container->call([$command, 'handle']);
            };
        }

        $response = $this->pipeline->send($command)->through($this->pipes)->then($callback);

        if ($command instanceof ShouldBeStored) {
            $this->store($command);
        }

        return $response;
    }

    protected function store(ShouldBeStored $command)
    {
        try {
            $encoders = [new JsonEncoder()];
            $normalizers = [new ObjectNormalizer()];
            $serializer = new SymfonySerializer($normalizers, $encoders);

            /*
             * We call __sleep so `Illuminate\Queue\SerializesModels` will
             * prepare all models in the event for serialization.
             */
            if (method_exists($command, '__sleep')) {
                $command->__sleep();
            }

            $properties = $serializer->serialize($command, 'json');

            $storedJob = new StoredJob([
                'user_id' => auth()->check() ? auth()->user()->id : null,
                'class_name' => get_class($command),
                'properties' => $properties
            ]);

            $storedJob->save();
        } catch (\Exception $e) {
            Log::alert($e->getMessage());
        }
    }
}
