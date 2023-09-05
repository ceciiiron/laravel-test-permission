<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::user()) {
            return response()->json(["message" => "You are currently logged in", "user" => Auth::user()->testing], 200);
        }

        if (Auth::attempt($credentials)) {
            return response()->json(["message" => "Logged in"], 200);
        } else {
            return response()->json(["user" => "Incorrect username or password"], 400);
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return $request->expectsJson() ? ["message" => "Logged out successfully"] : redirect()->route('login');
    }
}
