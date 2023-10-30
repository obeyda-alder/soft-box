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

    if (in_array($model, ['siteHeaders', 'siteNavbarItem', 'siteBlogs', 'siteOurServicesSliders', 'siteConfig', 'sitePortfolioImages', 'siteWhyUsItems', 'siteLanguages'])) {
      if ($model == "siteConfig") {
        return $query->pluck('value', 'key')->toArray();
      } else if ($model == "siteLanguages") {
        return $query->where('status', true)->get();
      } else if (!in_array($model, ['siteLanguages', 'siteConfig'])) {
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
      $locale = session()->get('locale');
    } elseif ($request->has('locale') && array_key_exists($request->locale, config('translatable.locales'))) {
      $locale = $request->locale;
      session()->put('locale', $locale);
    } else {
      $locale = $this->locale;
      session()->put('locale', $locale);
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
      'siteBlogs',
      'siteLatestInCrope',
      'siteWhyUsItems',
      'siteNewsLetter',
      'siteContactUs'
    ];

    $data = [];

    $logo_key = 'logo_' . $locale;
    $data['logo'] = siteConfig::where('key', $logo_key)->first()->value ?? false;
    $data['locale'] = $locale;

    foreach ($models as $model) {
      $data[$model] = $this->fetchModel($model, $locale);
    }

    return view('frontEnd.content.home.index', compact('data'));
  }

  public function selectLang(Request $request)
  {
    $this->locale = $request->locale;
    session()->put('locale', $request->locale);
    return true;
  }
}
