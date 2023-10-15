<?php

namespace App\Http\Controllers\BackEnd\Authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
  public function index()
  {
    return view('backEnd.content.authentications.auth-forgot-password-basic');
  }
}
