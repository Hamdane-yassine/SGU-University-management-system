<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MarkNotificationAsRead
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->has('idNotif')){
            $notification = $request->user()->notifications()->where('id', $request->idNotif)->first();
            if($notification) {
                $notification->markAsRead();
            }
        }
        return $next($request);
    }
}
