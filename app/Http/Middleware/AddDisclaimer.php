<?php

namespace App\Http\Middleware;

use Closure;

class AddDisclaimer
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->server->get('HTTP_HOST') === 'gielda-gier.ivankayzer.com') {
            session()->flash('message', [
                'text' => __('common.disclaimer'),
                'type' => 'warning',
            ]);
        }

        return $next($request);
    }
}
