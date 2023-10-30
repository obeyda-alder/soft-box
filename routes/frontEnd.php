<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontEnd\HomeController;

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
  return redirect()->route('web:home');
});

Route::middleware('check.site.status')->name('web:')->group(function () {
  Route::get('home', [HomeController::class, 'index'])->name('home');
  Route::post('select-lang', [HomeController::class, 'selectLang'])->name('select-lang');
});
