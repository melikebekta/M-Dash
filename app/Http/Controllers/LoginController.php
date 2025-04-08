<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('index');
        }
        return view('login');
    }
    public function login(Request $request)
    {
        $auth = User::where('email', $request->email)->first();
        if ($auth && Hash::check($request->password , $auth->password)) {
            Auth::login($auth);
            return redirect()->route('index');
        }
        else {
            return redirect()->back()->with('error', 'Invalid credentials');
        }
    }
}
