<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckProf
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
        // && $request->user()->professeur->chefdep->ID_chef === $request->user()->id
        if ($request->user()->hasRole('prof') || ($request->user()->hasRole('chefdep')  ) ) {
            return $next($request);
        }
        return redirect('/');
    }
}
