<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsCashboxOpening
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
        $open_closed_cashbox_id = auth()->user()->open_closed_cashbox_id;

        if ( is_null($open_closed_cashbox_id) ) {

            return redirect()->route('web.cajas')->with('status', 'Tiene que aperturar una caja primero');

        }

        return $next($request);
    }
}
