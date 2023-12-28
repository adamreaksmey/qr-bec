<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRegistrationRequest;
use App\Http\Requests\UserLoginForm;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(UserLoginForm $request)
    {
        // $request->validated();
        // $user = User::where('email', $request->email)->first();
        // if (!$user) {
        //     return response([
        //         'message' => 'User Not Found!',
        //         'success' => false
        //     ]);
        // }
        // if (Hash::check($request->password, $user->password)) {
        //     $token = $user->createToken('authToken')->plainTextToken;

        //     return response([
        //         'message' => 'Login Success',
        //         'success' => true,
        //         'user' => $user,
        //         'token' => $token,
        //     ]);
        // }
        $credentials = $request->validated();
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('bec-project')->accessToken;
            Auth::login($user, true);
            return redirect()->intended('dashboard');
        }
        return response([
            'message' => 'Email and Password  not found!',
            'success' => false,
        ]);
    }

    public function register(UserRegistrationRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);
        $validated['phone_number'] = str_replace(' ', '', $validated['phone_number']);

        $user = User::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            'authorization' => [
                'type' => 'bearer',
            ],
        ]);
    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully'], 200);
    }

    public function getRegisteredUser(Request $request)
    {
        return $this->apiResponse([
            "authUser" => auth()->user()
        ]);
    }
}
