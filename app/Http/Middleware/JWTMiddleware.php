<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        $message = '';

        //checks token validation
        try{
            JWTAuth::parseToken()->authenticate();
            return $next($request);
        }
        catch(\Tymon\JWTAuth\Exceptions\TokenExpiredException $e){
//do sth that will check if the token has expired
$message = 'Your token has expired';

        }

        catch(\Tymon\JWTAuth\Exceptions\JWTException $e){
//check if the token is there or not
$message = 'You have not provided a token';
        }
        catch(\Tymon\JWTAuth\Exceptions\TokenInvalidException $e){
//checks if the token entered is invalid or does not belong to that user
$message = 'This token does not belong to you';
        }

        return response()->json([
            'success' =>false,
            'message' => $message
        ]);
    }
}
