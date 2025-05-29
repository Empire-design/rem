<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\CategoryController;
use App\Models\Category;
use App\Models\User;
use App\Models\register;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function Afterregister()
    {
        // return view('afterregister', compact('user'));        

        if (Auth::id()) {
            $usertype = Auth()->user()->usertype;

            if ($usertype == 'admin') {
                $user = User::where("usertype", 'user')->get();
                return view('afterregister', compact('user'));
            } else {
                $user = [];
                return view('afterregister', compact('user'));
            }
        }
    }



    public function Login(string $id)
    {
        $user = User::find($id);
        $token = $user->createToken('Personal Access Token')->accessToken;
        return response()->json([
            'token' => $token
        ]);
    }
}













































































































    // public function logout(Request $request)
    // {

    //     Auth::logout();
    //     // Redirect to the home page (or any other page you want)
    //     return redirect('/');
    // }


    // public function register()
    // {
    //     return view('admin.register');
    // }
    // public function insertregister(Request $request)
    // {
    //     $register = new Register();
    //     $register->username = $request->username;
    //     $register->email = $request->email;
    //     $register->password = $request->password;
    //     $register->agree = $request->agree;
    //     $register->save();

    //     if ($register) {

    //         return redirect()->route('home')->with('status', 'Register successfully inserted');
    //     } else {
    //         return redirect()->back()->with('error', 'Register has not inserted');
    //     }
    // }
    // public function addlogin()
    // {
    //     return view('admin.login');
    // }
