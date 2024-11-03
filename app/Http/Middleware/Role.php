<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        $user = $request->user();
        if (!$user || !$user->getRoleNames()->contains($role)) {
            if ($user) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
            }
            
            return redirect(route('login'))->with([
                'notifications' => [ 
                    [
                        'type' => 'error',
                        'message' => 'Nu aveți permisiunile necesare pentru a vizualiza pagina pe care o căutați',
                    ]
                ]
            ]);
        }
        return $next($request);
    }
}
