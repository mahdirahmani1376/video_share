<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckEmailIsVerifiedMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if($request->user() ?? $request->user()->hasVerifiedEmail())
        {
            return $next($request);
        }

        return redirect()->route('index')->with('alert',__('messages.please_verify_your_email'));
    }
}
