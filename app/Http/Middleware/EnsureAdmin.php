<?php

namespace App\Http\Middleware;

use App\Models\Role;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        $adminRole = Role::whereName(config('role.admin'))->first();
        if(Auth::check()){
            foreach($user->roles as $role) {
                if ($role->is($adminRole))
                    return $next($request);
                else{
                    return redirect()->route('home.index');
                }
            }
        }
        else
        {
            return redirect()->route('login')
            ->with("You are not an admin");
        }
        
        

        
    }
}
