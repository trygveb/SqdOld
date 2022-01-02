<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class EnsureUserIsAdmin {

   /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure  $next
    * @return mixed
    */
   public function handle(Request $request, Closure $next) {
      if (Auth::check()) {
         $user=$request->user();
         $authority= $user->authority;
         if ($authority > 1) {
            return $next($request);
         }
      }

      return redirect('login');
   }

}
