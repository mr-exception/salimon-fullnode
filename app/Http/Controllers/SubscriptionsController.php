<?php

namespace App\Http\Controllers;

use App\Http\Requests\Subscriptions\SubmitRequest;
use App\Models\Subscription;
use App\Models\Transaction;

class SubscriptionsController extends Controller
{
  public function submit(SubmitRequest $request)
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
        "amount" => $amount * 1000000,
      ]);
    } else {
      $subscription->amount += $amount * 1000000;
      $subscription->save();
    }
    $transaction = Transaction::create([
      "address" => getAddress(),
      "amount" => $price,
      "type" => Transaction::OUT,
      "date" => time(),
      "description" => "subscription for $amount million packets",
    ]);
    return ["ok" => "true", "transaction_ref" => $transaction->id];
  }
}
