<?php

namespace App\Observers;

use App\Models\Packet;
use App\Models\Subscription;

class PacketsObserver
{
  public function created(Packet $packet)
  {
    $subscription = Subscription::where("address", $packet->src)->first();
    $subscription->amount -= 1;
    $subscription->save();
  }
}
