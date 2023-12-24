<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Exception;
use App\Http\Requests\UserRegistrationRequest;

class AuthController extends Controller
{
    public function __construct(private UserRegistrationRequest $userRequest)
    {
    }
    public function login()
    {
    }

    public function register(Request $request)
    {
        $validated = $this->userRequest->validated();
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = Auth::login($user);

        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
            ],
        ]);
    }


    public function logout()
    {
    }

    public function refresh()
    {
    }
}
