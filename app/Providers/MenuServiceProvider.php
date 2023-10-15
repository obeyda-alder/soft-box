<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
  /**
   * Bootstrap register.
   *
   * @return void
   */
  public function register()
  {
    $this->app->bind('menuData', function () {
      return include base_path('menu.php');
    });
  }

  /**
   * Bootstrap boot.
   *
   * @return void
   */
  public function boot()
  {
    //
  }

  /**
   * Bootstrap provides.
   *
   * @return void
   */
  public function provides()
  {
    return ['menuData'];
  }
}
