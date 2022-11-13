<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Support\Facades\Route;

class Admin
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
        //$controller = class_basename(Route::getCurrentRoute()->controller);
        $method = class_basename(Route::getCurrentRoute()->getActionMethod());
        $route = Route::getCurrentRoute()->getAction()['prefix'];
        try {
            if(!auth()->check()){
                return redirect(RouteServiceProvider::HOME);
            }
            if ($request->user()->isSuperUser()) {
                return $next($request);
            } else {
                $list_actions = ["index", "create", "edit", "show", "print", "destroy"];
                if (in_array($method, $list_actions)) { 
                    if (auth()->user()->can($route.'-'.$method)) {
                        return $next($request);
                     }
                    if ($request->ajax()) { 
                        throw new Exception("Authentication failure.", 500);
                    }
                    return redirect(RouteServiceProvider::HOME);
                } 

                return $next($request);
            }
        } catch (\Exception $e) {
            return response()->json(['errors' => ['error' => $e->getMessage(),"message"=> "Login data was invalid."]], 400);
        }
        return redirect(RouteServiceProvider::HOME);
    }
}
