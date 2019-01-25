<?php

namespace App\Services;

use App\City;
use App\Game;

class SelectValueResolver
{
    /**
     * @var string
     */
    private $type;

    private $value;

    private $defaultValue;

    private $resolvedValue = '';

    public function __construct(string $type, $defaultValue, $value = null)
    {
        $this->type = $type;
        $this->value = $value;
        $this->defaultValue = $defaultValue;

        $this->resolvedValue = $this->resolve();
    }

    public function __toString()
    {
        return $this->resolvedValue;
    }

    private function resolve()
    {
        $resolvedValue = '';

        if (!$this->value) {
            return $this->defaultValue;
        }

        switch ($this->type) {
            case 'city':
                $resolvedValue = City::find($this->value)->name;
                break;
            case 'games':
                $resolvedValue = Game::where('igdb_id', $this->value)->first()->title;
                break;
        }

        return $resolvedValue ?: $this->defaultValue;
    }
}