<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Setting;

class EnsureAdminPortalEnabled
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if this is an admin login path
        if ($request->is('admin/login')) {
            $isEnabled = Setting::get('admin_login_enabled', '1');
            if ($isEnabled == '0') {
                return redirect()->route('login')->with('status', '🛡️ Admin access is currently disabled. Please login as a standard user.');
            }
        }

        // Check if this is an admin registration path
        if ($request->is('admin/register')) {
            $isEnabled = Setting::get('admin_register_enabled', '1');
            if ($isEnabled == '0') {
                return redirect()->route('register')->with('status', '🛡️ Admin registration is currently closed. Please create a standard account.');
            }
        }

        return $next($request);
    }
}
