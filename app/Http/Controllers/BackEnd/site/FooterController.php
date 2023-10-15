<?php

namespace App\Http\Controllers\BackEnd\site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FooterController extends Controller
{
  public function index()
  {
    return view('backEnd.content.footer.index');
  }
}
