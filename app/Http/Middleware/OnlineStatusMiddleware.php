<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OnlineStatusMiddleware
{

    public function handle(Request $request, Closure $next): Response
    {
        $adminId = session('id');

        // If admin not logged in
        if (!$adminId) {
            return redirect()->route('login')
                ->withErrors('Session expired. Please login again.');
        }

        $admin = Admin::select('status')->where('id', $adminId)->first();

        // Check if admin exists and is active
        if (!$admin || $admin->status != 1) {
            // Optional: mark offline
            Admin::where('id', $adminId)->update(['online' => 0]);

            // Destroy session
            session()->flush();

            return redirect()->route('login')
                ->withErrors('Your account is inactive. Please contact admin.');
        }

        // Mark admin online
        Admin::where('id', $adminId)->update(['online' => 1]);

        return $next($request);
    }

}
