<?php

namespace App\Http\Middleware;

use App\Models\Subscription;
use Closure;
use Illuminate\Http\Request;

class CheckSubscription
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
    if (env("PAID_SUBSCRIPTION", false)) {
      $subscription = Subscription::whereAddress(strtolower($request->src))->first();
      if (!$subscription) {
        return abort(401, "you don't have subscription.");
      }
      if ($subscription->end < time()) {
        return abort(401, "your subscription is finished.");
      }
    }
    return $next($request);
  }
}
