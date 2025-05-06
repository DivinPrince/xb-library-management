<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $values = $request->validate([
            "email" => "required",
            "password" => "required"
        ]);
        if (Auth::attempt($values)) {
            return redirect("/");
        }

        return back()->with("errors", "Invalid Credentials");
    }
    public function register(Request $request)
    {
        $values = $request->validate([
            "email" => "required",
            "password" => "required",
            "name" => "required",
            "role" => "required",
        ]);

        $user = User::firstWhere("email", $values["email"]);

        if ($user) {
            return back()->withErrors([

                'error' => 'Invalid Credentials',

            ]);
        }

        $data = User::create($values);
        if (Auth::attempt($values) && $data) {
            return redirect("/");
        }

        return back()->withErrors([

            'error' => 'Invalid Credentials',

        ]);
    }

    public function logout(Request $request)
    {

        Auth::logout();



        $request->session()->invalidate();



        $request->session()->regenerateToken();



        return redirect('/login');

    }
}
