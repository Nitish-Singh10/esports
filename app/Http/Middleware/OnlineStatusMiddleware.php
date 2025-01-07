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
        $status = Admin::where('id', session('id'))->value('status');
        if ($status) {
            Admin::where('id', session('id'))->update(['online' => 1]);
        }
        return $next($request);
    }
}
