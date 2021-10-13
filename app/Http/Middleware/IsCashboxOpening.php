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
        $cashbox = auth()->user()->cashbox_id;

        if ( is_null($cashbox) ) {

            // return response()->json([
            //     'message' => 'Usted no aperturo ninguna caja'
            // ]);

            return redirect()->back()->with('status', 'Tiene que aperturar una caja primero');           ;
        }

        return $next($request);
    }
}
