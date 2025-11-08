<?php

namespace App\Http\Middleware;

use App\Models\Login;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserLoginCheck
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */

    public function handle(Request $request, Closure $next): Response
    {
        $loginCount = Login::where('user_id', auth()->id())->count();

        if ($loginCount < 3) {
            return redirect()->route('dashboard')
                ->with('error', 'You need to log in at least 3 times before creating a tactic');
        }

        return $next($request);
    }
}
