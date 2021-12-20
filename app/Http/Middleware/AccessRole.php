<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class AccessRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {

        $isAuth = Auth::guard('api')->check();
        $user = Auth::guard('api')->user();

        $code = 403;

        if(!$isAuth){
            // redirect page or error.
            $output = ['code' => $code,
                'msg' => 'Unauthenticated'];

            return response()->json($output, $code);
        } elseif ($user->role && ($authRole = $user->role)) {
            $requestRoles = explode("|", $role);

            if (!in_array($authRole->name, $requestRoles)) {
                $output = ['code' => $code,
                'msg' => 'You have no access for this resources'];
                return response()->json($output, $code);
            }
        }

        return $next($request);
    }
}