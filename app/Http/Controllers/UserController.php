<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function register()
    {
    }

    function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $success["token"] = $user->createToken("App")->plainTextToken;
            $success["user"] = $user->name;
            return response()->json($success);
        } else {
            return response()->json("Failed");
        }

    }
}
