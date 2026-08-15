<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       $user = $request->user();

       if (! $user) {
          return redirect()->route('login');
       }

       if (! $user->is_admin) {
          Auth::logout();
          $request->session()->invalidate();
          $request->session()->regenerateToken();

          return redirect()->route('login')
             ->with('error', 'Akun anda bukan admin. Silahkan login dengan akun administrator.');
       }
       
        return $next($request);
    }
}
