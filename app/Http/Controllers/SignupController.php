<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignupController extends Controller
{
    public function index()
    {
        return view('signup');
    }
    // public function register(Request $request)
    // {
    //     $validate = $request->validate([
    //         'name' => 'required',
    //         'email' => 'required|email|unique:admin',
    //         'password' => 'required|min:6|confirmed',
    //     ]);

    //     $validate['password'] = bcrypt($validate['password']);

    //     $user = User::create($validate);

    //     Auth::login($user);

    //     return redirect()->route('index')
    //         ->with('success', 'Kayıt başarıyla oluşturuldu!')
    //         ->withErrors([
    //             'email' => 'Bu e-posta adresi zaten kayıtlı.',
    //             'password' => 'Parola en az 6 karakter olmalıdır.',
    //             'name' => 'İsim alanı gereklidir.',
    //         ]);
    // }

    public function register(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admin',
            'password' => 'required|min:6|confirmed',
        ]);

        $validate['password'] = bcrypt($validate['password']);

        try {
            $user = User::create($validate);
            Auth::login($user);
            return redirect()->route('index')
                ->with('success', 'Kayıt başarıyla oluşturuldu!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Kayıt sırasında bir hata oluştu: ' . $e->getMessage());
        }
    }

}
