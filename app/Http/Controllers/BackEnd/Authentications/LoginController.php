<?php

namespace App\Http\Controllers\BackEnd\Authentications;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
  public function showLoginForm()
  {
    return view('backEnd.content.authentications.login');
  }

  public function login(Request $request)
  {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
      return redirect()->route('admin:dashboard');
    }

    return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
  }

  public function logout()
  {
    Auth::logout();
    return redirect()->route('admin:login');
  }
}
