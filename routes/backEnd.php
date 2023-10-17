<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackEnd\site\WhyUsController;
use App\Http\Controllers\BackEnd\Users\UserController;
use App\Http\Controllers\BackEnd\site\ConfigController;
use App\Http\Controllers\BackEnd\site\FooterController;
use App\Http\Controllers\BackEnd\site\HeaderController;
use App\Http\Controllers\BackEnd\site\NavbarController;
use App\Http\Controllers\BackEnd\site\AboutUsController;
use App\Http\Controllers\BackEnd\site\PortfolioController;
use App\Http\Controllers\BackEnd\site\NewsLetterController;
use App\Http\Controllers\BackEnd\site\OurServicesController;
use App\Http\Controllers\BackEnd\site\LatestInCropeController;
use App\Http\Controllers\BackEnd\Dashboard\AnalyticsControoler;
use App\Http\Controllers\BackEnd\Authentications\LoginController;
use App\Http\Controllers\BackEnd\Authentications\ForgotPasswordController;
use App\Http\Controllers\BackEnd\site\ContactUsController;
use App\Http\Controllers\loadPartialViewController;

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


Route::name('admin:')->group(function () {
  Route::get('auth/login', [LoginController::class, 'showLoginForm'])->name('login');
  Route::post('auth/login', [LoginController::class, 'login'])->name('login');
  Route::post('auth/logout', [LoginController::class, 'logout'])->name('logout');
  Route::get('auth/forgot-password', [ForgotPasswordController::class, 'index'])->name('reset-password');
});

Route::middleware(['auth'])->name('admin:')->group(function () {

  // loadPartial.
  Route::get('loadPartial', [loadPartialViewController::class, 'loadPartial'])->name('load_partial');

  // dashboard.
  Route::get('dashboard', [AnalyticsControoler::class, 'index'])->name('dashboard');

  // users.
  Route::get('users', [UserController::class, 'index'])->name('users');
  Route::get('users/dataTable', [UserController::class, 'dataTable'])->name('users:dataTable');
  Route::get('users/create/{type}', [UserController::class, 'create'])->name('users:create');
  Route::post('users/store/{type}', [UserController::class, 'store'])->name('users:store');
  Route::get('users/show/{user}', [UserController::class, 'show'])->name('users:show');
  Route::get('users/edit/{user}', [UserController::class, 'edit'])->name('users:edit');
  Route::get('users/delete/{user}', [UserController::class, 'delete'])->name('users:delete');
  Route::get('users/restore/{user}', [UserController::class, 'restore'])->name('users:restore');
  Route::get('users/destroy/{user}', [UserController::class, 'destroy'])->name('users:destroy');

  // navbar.
  Route::get('navbar', [NavbarController::class, 'index'])->name('navbar');
  Route::post('navbar/return_and_update_navbar', [NavbarController::class, 'return_and_update_navbar'])->name('navbar:return_and_update_navbar');

  // header.
  Route::get('header', [HeaderController::class, 'index'])->name('header');
  Route::post('header/save', [HeaderController::class, 'save'])->name('header:save');
  Route::get('header/fetch_data', [HeaderController::class, 'data'])->name('header:fetch_data');
  Route::post('header/delete', [HeaderController::class, 'delete'])->name('header:delete');

  // about-us.
  Route::get('about-us', [AboutUsController::class, 'index'])->name('about-us');
  Route::post('about-us/save', [AboutUsController::class, 'save'])->name('about-us:save');

  // our-services.
  Route::get('our-services', [OurServicesController::class, 'index'])->name('our-services');
  Route::post('our-services/save', [OurServicesController::class, 'save'])->name('our-services:save');
  Route::get('our-services/fetch_data', [OurServicesController::class, 'data'])->name('our-services:fetch_data');
  Route::post('our-services/delete', [OurServicesController::class, 'delete'])->name('our-services:delete');

  // why-us.
  Route::get('why-us', [WhyUsController::class, 'index'])->name('why-us');
  Route::post('why-us/save', [WhyUsController::class, 'save'])->name('why-us:save');

  // portfolio.
  Route::get('portfolio', [PortfolioController::class, 'index'])->name('portfolio');
  Route::post('portfolio/save-section', [PortfolioController::class, 'saveSection'])->name('portfolio:save-section');
  Route::post('portfolio/save-tab', [PortfolioController::class, 'saveTabs'])->name('portfolio:save-tab');
  Route::get('portfolio/fetch_data', [PortfolioController::class, 'dataImages'])->name('portfolio:fetch_data');
  Route::post('portfolio/delete', [PortfolioController::class, 'deleteImages'])->name('portfolio:delete');




  Route::get('latest-in-crope', [LatestInCropeController::class, 'index'])->name('latest-in-crope');

  // news-letter.
  Route::get('news-letter', [NewsLetterController::class, 'index'])->name('news-letter');
  Route::post('news-letter/save', [NewsLetterController::class, 'save'])->name('news-letter:save');

  // footer.
  Route::get('footer', [FooterController::class, 'index'])->name('footer');
  Route::post('footer/save', [FooterController::class, 'save'])->name('footer:save');

  // contact us.
  Route::get('contact-us', [ContactUsController::class, 'index'])->name('contact-us');
  Route::post('contact-us/save', [ContactUsController::class, 'save'])->name('contact-us:save');

  // config.
  Route::get('config', [ConfigController::class, 'index'])->name('config');
  Route::post('config/add-languages', [ConfigController::class, 'addLanguages'])->name('config:add-languages');
  Route::post('config/edit-languages', [ConfigController::class, 'editLanguages'])->name('config:edit-languages');
  Route::post('config/delete-languages', [ConfigController::class, 'deleteLanguages'])->name('config:delete-languages');
  Route::get('config/languages', [ConfigController::class, 'languages'])->name('config:languages');
  Route::post('config/add-config', [ConfigController::class, 'addConfig'])->name('config:add-config');
});
