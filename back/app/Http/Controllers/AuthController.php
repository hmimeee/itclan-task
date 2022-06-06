<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Login using email and password
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user =  auth()->user();
            $token = $user->createToken($user->email)->plainTextToken;

            return $this->apiResponse(null, 200, [
                'token' => $token,
                'user' => $user
            ]);
        }

        return $this->apiResponse('Invalid credentials', 401);
    }

    /**
     * Register using name, email and password
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:5',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8'
        ]);

        $data = $request->only('name', 'email');
        $data['password'] = Hash::make($request->password);

        $user = User::create($data);
        $token =  $user->createToken($user->email)->plainTextToken;

        return $this->apiResponse('Registration successfull', 200, [
            'token' => $token,
            'user' => $user
        ]);
    }
}
