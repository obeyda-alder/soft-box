<?php

namespace App\Http\Controllers\BackEnd\site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WhyUsController extends Controller
{
  public function index()
  {
    return view('backEnd.content.why-us.index');
  }
}