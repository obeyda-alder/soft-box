<?php

namespace App\Http\Middleware;

use Closure;

class RedirectToWeb
{
  public function handle($request, Closure $next)
  {
    if ($request->is('/')) {
      return redirect('/web' . $request->getRequestUri());
    }

    return $next($request);
  }
}
