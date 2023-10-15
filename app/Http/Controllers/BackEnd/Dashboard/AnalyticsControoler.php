<?php

namespace App\Http\Controllers\BackEnd\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnalyticsControoler extends Controller
{
  public function index()
  {
    return view('backEnd.content.dashboard.dashboards-analytics');
  }
}
