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
        Auth::logout(); // Log out the authenticated user
        $request->session()->invalidate(); // Invalidate the user's session
        $request->session()->regenerateToken(); // Regenerate the CSRF token

        return redirect()->route('login')->with('success', 'You have been logged out.');
    }


    public function getRegisteredUser(Request $request)
    {
        return $this->apiResponse([
            "authUser" => auth()->user()
        ]);
    }
}
