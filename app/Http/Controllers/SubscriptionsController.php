<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmitSubscriptionRequest;
use App\Models\Subscription;
use App\Models\Transaction;

class SubscriptionsController extends Controller
{
  public function submit(SubmitSubscriptionRequest $request)
  {
    $amount = $request->amount;
    $price = $amount * env("SUBSCRIPTION_FEE");

    $balance = Transaction::getAddressBalance(getAddress());
    if ($balance < $price) {
      return abort(402, "not enough balance");
    }

    $subscription = Subscription::where("address", getAddress())->first();
    if (!$subscription) {
      $subscription = Subscription::create([
        "address" => getAddress(),
        "end" => time() + $amount * 3600,
      ]);
    } else {
      if ($subscription->end < time()) {
        $subscription->end = time() + $amount * 3600;
      } else {
        $subscription->end += $amount * 3600;
      }
      $subscription->save();
    }
    $transaction = Transaction::create([
      "address" => getAddress(),
      "amount" => $price,
      "type" => Transaction::OUT,
      "date" => time(),
      "description" => "subscription for $amount hours",
    ]);
    return ["ok" => "true", "transaction_ref" => $transaction->id];
  }
}
