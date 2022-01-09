<?php

namespace App\Http\Middleware;

use App\Models\OpenClosedCashbox;
use Closure;
use Illuminate\Http\Request;

class IsYourOpening
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $id)
    {
        $occ = OpenClosedCashbox::findOrFail($id);
        $userId = auth()->user()->id;

        if ($occ->user_id == $userId) {
            return $next($request);
        } else {
            return redirect()->back()->with('status', 'Esta no es su apertura');
        }

    }
}
