<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

 
class LoginController extends Controller
{
    /**
     * @OA\Post(
     *      path="/user/auth",
     *      operationId="auth",
     *      tags={"Auth"},
     *      summary="Get Authenticate user",
     *      description="Returns user token",
     *      @OA\Parameter(
     *          name="email",
     *          in="query",
     *          required=true,
     *          description="User email address",
     *          @OA\Schema(
     *              type="string"
     *          ),
     *      ),
     *      @OA\Parameter(
     *          name="password",
     *          in="query",
     *          required=true,
     *          description="User password",
     *          @OA\Schema(
     *              type="string"
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\JsonContent()
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden",
     *          @OA\JsonContent()
     *      )
     *     )
     */
    public function auth(AuthRequest $request){
        
        $login = [
            'email'=> $request->email,
            'password'=> $request->password
        ];

        if(!Auth::attempt($login)){
            return response(['message' => 'Invalid login credentials']);
        }

        $accessToken = Auth::user()->createToken('authToken')->accessToken;
        return response(['user'=> Auth::user(), 'access_token'=> $accessToken]);
    }

    /**
     * @OA\Post(
     *      path="/user/register",
     *      operationId="regiter",
     *      tags={"Auth"},
     *      summary="Create new user",
     *      description="Returns created user",
     *      @OA\Parameter(
     *          name="name",
     *          in="query",
     *          required=true,
     *          description="User name",
     *          @OA\Schema(
     *              type="string"
     *          ),
     *      ),
     *      @OA\Parameter(
     *          name="email",
     *          in="query",
     *          required=true,
     *          description="User email address",
     *          @OA\Schema(
     *              type="string"
     *          ),
     *      ),
     *      @OA\Parameter(
     *          name="password",
     *          in="query",
     *          required=true,
     *          description="User password",
     *          @OA\Schema(
     *              type="string"
     *          ),
     *      ),
     *      @OA\Parameter(
     *          name="role",
     *          in="query",
     *          required=false,
     *          description="User Role",
     *          @OA\Schema(
     *              type="string"
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\JsonContent()
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden",
     *          @OA\JsonContent()
     *      )
     *     )
     */
    public function register(UserRegisterRequest $request){
        
        try {
            $roleId = 0;
            if (isset($request->role)) {
                $role = Role::whereName($request->role)->first();
                $roleId = $role ? $role->id : 0;
            }

            if ($roleId == 0) {
                $role = Role::whereName(Role::VIEWER)->first();
                $roleId = $role ? $role->id : 0;
            }

            $user = New User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role_id = $roleId;
            $user->password = Hash::make($request->password);
            $user->save();
            return response(['user'=> $user, 'message'=> 'user created']);
        } catch (\Throwable $th) {
            return response(['message'=> 'user faield'], 500);
        }
    }

    /**
     * @OA\Get(
     *      path="/user/authUser",
     *      operationId="authUser",
     *      tags={"Auth"},
     *      summary="Get user details by token",
     *      description="Returns auth user",
     *      security={{"bearerAuth":{}}},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\JsonContent()
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden",
     *          @OA\JsonContent()
     *      )
     *     )
     */
    public function authUser(Request $request){
        
        $user = Auth::guard('api')->user();
        return response(['user'=> $user]);
    }

    /**
     * @OA\Get(
     *      path="/user/{id}",
     *      operationId="getUserById",
     *      tags={"Auth"},
     *      summary="Get user details by id",
     *      description="Returns user",
     *      security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="User id of table",
     *          @OA\Schema(
     *              type="number"
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\JsonContent()
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden",
     *          @OA\JsonContent()
     *      )
     *     )
     */
    public function getUserById(Request $request){
        
        $user = User::find($request->id);
        return response(['user'=> $user]);
    }

}