<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\siteConfig;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
  protected $locale;

  function fetchModel($model, $locale)
  {
    $query = app("App\\Models\\$model");

    if (in_array($model, ['siteHeaders', 'siteNavbarItem', 'siteOurServicesSliders', 'sitePortfolioImages', 'siteWhyUsItems'])) {
      if (!in_array($model, ['siteLanguages'])) {
        return $query->where('locale', $locale)->get();
      } else {
        return $query->get();
      }
    } else {
      return $query->first();
    }
  }

  public function index(Request $request)
  {
    $this->locale = 'en';

    if (session()->has('locale')) {
      $selectedLocale = session()->get('locale');
    } elseif ($request->has('locale') && array_key_exists($request->locale, config('translatable.locales'))) {
      $selectedLocale = $request->locale;
      session()->put('locale', $selectedLocale);
    } else {
      $selectedLocale = $this->locale;
      session()->put('locale', $selectedLocale);
    }

    $models = [
      'siteAboutUs',
      'siteConfig',
      'siteFooter',
      'siteHeaders',
      'siteLanguages',
      'siteNavbar',
      'siteNavbarItem',
      'siteOurServices',
      'siteOurServicesSliders',
      'sitePortfolio',
      'sitePortfolioImages',
      'siteWhyUs',
      'siteWhyUsItems',
    ];

    $data = [];

    $logo_key = 'logo_' . $selectedLocale;
    $data['logo'] = siteConfig::where('key', $logo_key)->first()->value ?? false;

    foreach ($models as $model) {
      $data[$model] = $this->fetchModel($model, $selectedLocale);
    }

    return view('frontEnd.content.home.index', compact('data'));
  }
}
