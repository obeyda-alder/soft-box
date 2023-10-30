<?php

namespace App\Http\Controllers\BackEnd\Dashboard;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\siteLanguages;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;

class AnalyticsControoler extends Controller
{
  protected $analytics = [];

  private function getModelAnalytics()
  {
    $path = app_path('Models');
    $results = scandir($path);

    foreach ($results as $result) {
      if ($result === '.' or $result === '..') continue;
      $filename = $result;

      if (is_file($path . '/' . $filename)) {
        $modelName = pathinfo($filename, PATHINFO_FILENAME);
        $modelClass = 'App\\Models\\' . $modelName;

        if (class_exists($modelClass)) {
          if (Schema::hasColumn((new $modelClass)->getTable(), 'locale')) {
            foreach (siteLanguages::pluck('name', 'code')->toArray() as $code => $name) {
              $count = $modelClass::where('locale', $code)->count();
              $shortName = str_replace('site', '', $modelName);
              $this->analytics[$shortName][$name] = $count;
            }
          } else {
            $count = $modelClass::count();
            $shortName = str_replace('site', '', $modelName);
            $this->analytics[$shortName] = $count;
          }
        }
      }
    }
  }

  public function index()
  {
    $this->getModelAnalytics();
    return view('backEnd.content.dashboard.dashboards-analytics')->with(['analytics' => $this->analytics]);
  }
}
