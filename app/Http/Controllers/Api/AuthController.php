<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:255",
            "email" => "required|string|email|unique:users",
            "password" => "required|string|min:8",
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password), 
        ]);

        $accessToken = $user->createToken('Personal Access Token')->accessToken;

        return response()->json([
            'user' => $user,
            'access_token' => $accessToken,
        ], 201);
    }


    public function login(Request $request)
    {
        // $loginData = $request->validate([
        //     'email' => 'required|string|email',
        //     'password' => 'required|string',
        // ]);
        $validator = Validator::make($request->all(), [
            "email" => "required|string|email",
            "password" => "required|string",
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        if (!auth()->attempt($validator->validated())) {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 422);
        }

        $user = auth()->user();
        $accessToken = $user->createToken('Personal Access Token')->accessToken;

        return response()->json([
            'user' => $user,
            'access_token' => $accessToken,
        ]);
    }
    // //////////////////////////
    
}
















// }
// [
//             'name' => $registerData['name'],
//             'email' => $registerData['email'],
//             'password' => Hash::make($registerData['password']),

//         ]