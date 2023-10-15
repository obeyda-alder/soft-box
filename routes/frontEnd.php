<?php

use App\Http\Controllers\Authentications\ForgotPasswordController;
use App\Http\Controllers\Authentications\LoginController;
use App\Http\Controllers\Authentications\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\AnalyticsControoler;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  return redirect()->route('admin:dashboard');
});