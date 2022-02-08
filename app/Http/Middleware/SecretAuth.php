<?php

namespace App\Http\Middleware;

use App\Models\Signature;
use Closure;
use Illuminate\Http\Request;

class SecretAuth
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
    if (!$request->hasHeader("x-secret")) {
      return abort(401, "invalid secret key");
    }
    if (!$request->hasHeader("x-address")) {
      return abort(401, "invalid address");
    }
    $address = getAddress();
    if (
      !Signature::where("address", $address)
        ->where("secret", md5($request->header("x-secret")))
        ->first()
    ) {
      return abort(401, "invalid auth headers");
    }
    return $next($request);
  }
}
