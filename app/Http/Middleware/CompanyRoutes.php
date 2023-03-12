<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class CompanyRoutes
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $hashedToken = $request->bearerToken();
            $token = PersonalAccessToken::findToken($hashedToken);

            if ($token->name == 'compTokenapp') {
                return $next($request);
            }

            return response()->json([
                'message' => 'access denied',
            ], 401);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'access denied',
            ], 401);
        }
    }
}
