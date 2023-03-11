<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class DeliveryRoutes
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
        $hashedToken = $request->bearerToken();
        $token = PersonalAccessToken::findToken($hashedToken);

        if ($token->name == 'deliveryGuyToken') {
            return $next($request);
        }

        return response()->json([
            'message' => 'access denied',
        ], 501);
    }
}
