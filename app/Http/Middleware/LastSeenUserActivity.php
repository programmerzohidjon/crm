<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Auth;
use Cache;
use Carbon\Carbon;

class LastSeenUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $expiretime = Carbon::now()->addMinute(1);
            Cache::put('is_online'.Auth::user()->id,true,$expiretime);
            User::where('id',Auth::user()->id)->update(['last_seen' => Carbon::now()]);
        }
        return $next($request);
    }
}
