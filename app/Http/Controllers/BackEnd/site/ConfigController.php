<?php

namespace App\Http\Controllers\BackEnd\site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
  public function index(Request $request)
  {
    return view('backEnd.content.config.index');
  }
}