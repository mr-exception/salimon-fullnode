<?php

namespace App\Observers;

use App\Models\Subscription;
use App\Models\Transaction;

class TransactionObserver
{
  public function created(Transaction $transaction)
  {
    $subscription = Subscription::whereAddress($transaction->address)->first();
    if (!$subscription) {
      $subscription = new Subscription();
      $subscription->address = $transaction->address;
      $subscription->end = 0;
    }
    if ($subscription->end > time()) {
      $subscription->end += $transaction->amount * 3600;
    } else {
      $subscription->end = time() + $transaction->amount * 3600;
    }
    $subscription->save();
  }
}
