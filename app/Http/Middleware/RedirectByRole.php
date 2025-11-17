<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectByRole
{
    public function handle(Request $request, Closure $next)
    {
        $u = $request->user();

        if ($u) {
            if (method_exists($u, 'hasRole')) {
                if ($u->hasRole('Admin')) {
                    return redirect()->route('admin.dashboard');
                }
                if ($u->hasRole('Inspector')) {
                    return redirect()->route('inspector.dashboard');
                }
                return redirect()->route('user.dashboard');
            }
            // jika spatie belum aktif, fallback
            return redirect()->route('user.dashboard');
        }

        return $next($request);
    }
}
