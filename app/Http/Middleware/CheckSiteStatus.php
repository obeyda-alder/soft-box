<?php

namespace App\Http\Middleware;

use App\Models\siteConfig;
use Closure;
use Illuminate\Http\Request;

class CheckSiteStatus
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
   * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
   */
  public function handle(Request $request, Closure $next)
  {
    $status = siteConfig::where('key', 'site_status')->first();
    if ($status && !($status->value == "on")) {
      return response()->view('frontEnd.content.404', [], 500);
    }

    return $next($request);
  }
}
