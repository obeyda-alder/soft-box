<?php

namespace App\Providers;

use App\Models\siteLanguages;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    //
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    $languages = siteLanguages::getLanguageData();
    if ($languages) {
      Config::set('translatable.locales', $languages);
    }
  }
}
