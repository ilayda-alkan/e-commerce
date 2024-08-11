<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

class AuthController extends Controller
{
    
    public function showLoginForm()
    {
        if (!Session::has('user'))
            return view('login');    
        return redirect()->route('home');
    }

    public function Login(Request $request)
    {
        // Giriş bilgilerini doğrulama
        $credentials = $request-> validate([
            'email' => 'required|email',
            'password' => 'required|string',

        ]);

         // Kullanıcıyı veritabanında bulma
        $user = User::where('email', $credentials['email'])->first();

        if(!$user){
            return back()->with('error', 'Not found user!!');
        }

        if ($user && (Hash::check($credentials['password'], $user->password))) {
            // Store user information in session
            Session::put('user', $user);

            // Redirect to the home
            return redirect()->route('home');
        }
        

        return back()->with('error', 'Password incorrect!!');
 
    }


    public function logout(Request $request)
    {
        Session::forget('user');

        return redirect()->route('login');
    }
    
}
