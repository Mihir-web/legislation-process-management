<?php
  
namespace App\Http\Middleware;
  
use Closure;
   
class IsMp
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
        if(auth()->user()->role_id <= 2){
            return $next($request);
        }
   
        return abort(404);
    }
}