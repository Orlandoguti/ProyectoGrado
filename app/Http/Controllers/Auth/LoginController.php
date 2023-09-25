<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class LoginController extends Controller
{
    public function showLoginForm(){
        return view('auth.login');
    }

    public function login(Request $request){
        $this->validateLogin($request);

        $user = User::where('email', $request->email)->first();

        if ($user && $user->condicion == 1 && Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('main');
        } elseif ($user && $user->condicion == 0) {
            return redirect()->back()->withErrors(['message' => 'Este usuario está desactivado. Contacte al Administrador.']);
        }

        return redirect()->back()->withErrors(['message' => 'Los datos ingresados no coinciden con nuestros registros. Revise sus datos o contacte al Administrador.']);
    }

    protected function validateLogin(Request $request){
        $this->validate($request,[
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/');
    }

}
