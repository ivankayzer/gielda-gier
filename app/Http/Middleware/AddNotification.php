<?php

namespace App\Http\Middleware;

use Closure;

class AddNotification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!auth()->check()) {
            return $next($request);
        }

        $profile = $request->user()->profile;

        if (!$profile->address || !$profile->zip || !$profile->bank_nr) {
            session()->flash('message', [
                'text' => __('common.fill_profile', ['url' => route('settings.index')]),
                'type' => 'warning'
            ]);
        }

        return $next($request);
    }
}
