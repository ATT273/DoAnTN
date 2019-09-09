<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class AdminMiddlewareApi
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
        
       // if(Auth::check()){
       //      $user = Auth::user();
       //      if($user->role == 1){
       //          return $next($request);
       //      }else{
       //      	$response["status"] = 250;
       //      	$response["message"] = 'Login Fail';
       //          return response()->json($response);
       //      }
       //  }
       //  else{
       //     	$response["status"] = 250;
       //  	$response["message"] = 'Login Fail';
       //      return response()->json($response);
       //  }
    }
}
