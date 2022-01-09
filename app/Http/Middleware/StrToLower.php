<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class StrToLower
{
  private $whitelist = ["src", "dst", "address"];
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
   * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
   */
  public function handle(Request $request, Closure $next)
  {
    $inputs = $request->all();
    foreach ($this->whitelist as $param) {
      if (isset($inputs[$param])) {
        $inputs[$param] = strtolower($inputs[$param]);
      }
    }
    $request->replace($inputs);
    return $next($request);
  }
}
