<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('userProfile');
    }
    public function update(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
            'new_password_confirmation' => 'required|min:6',
        ]);
    
        $user = auth()->user();
    
        if (!password_verify($request->old_password, $user->password)) {
            return redirect()->back()->withErrors(['old_password' => 'Girdiğiniz eski şifre hatalı.']);
        }
    
        $user->password = bcrypt($request->new_password);
        $user->save();
        return redirect()->back()->with('success', 'Şifreniz başarıyla güncellendi!');
    }
    
    

}
