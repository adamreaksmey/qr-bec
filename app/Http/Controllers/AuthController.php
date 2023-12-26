<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Exception;
use App\Http\Requests\UserRegistrationRequest;
use App\Http\Requests\UserLoginForm;
use Tymon\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class AuthController extends Controller
{

    public function login(UserLoginForm $request)
    {

        // try {
            $validated = $request->validated();
            $credentials = $request->only('email', 'password');
    
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
    
            return response()->json([
                'status' => 'success',
                'token' => $token
            ]);
        // } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
        //     try {
        //         $token = JWTAuth::refresh(JWTAuth::getToken());
        //         return response()->json(['newToken' => $token], 200);
        //     } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
        //         return response()->json(['error' => $e], 401);
        //     }
        // }
    }

    public function register(UserRegistrationRequest $request)
    {
        $validated = $request->validated();

        $password = Hash::make($request->phone_number);
        $user = User::create(array_merge($request->except('password'), [
            "password" => $password
        ]));

        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            'authorization' => [
                // 'token' => $token,
                'type' => 'bearer',
            ],
        ]);
    }


    public function logout()
    {
        JWTAuth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        $token = JWTAuth::getToken();

        if (! $token) {
            throw new BadRequestHttpException('Token not provided');
        }

        try {
            $token = JWTAuth::refresh($token);
        } catch (TokenInvalidException $e) {
            throw new AccessDeniedHttpException('The token is invalid');
        }

        return response()->json(compact('token'));
    }
}
