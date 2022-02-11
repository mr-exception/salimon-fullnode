<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckAddressListRequest;
use App\Models\Signature;
use App\Models\Subscription;
use App\Models\Transaction;
use Illuminate\Http\Request;

class AddressController extends Controller
{
  public function checkAddressList(CheckAddressListRequest $request)
  {
    $address_list = [];
    foreach ($request->addresses as $address) {
      $signaure = Signature::where("address", strtolower($address))->first();
      if ($signaure) {
        $address_list[strtolower($address)] = [
          "public_key" => $signaure->public_key,
        ];
      }
    }
    return $address_list;
  }
  public function getHeartBeat(Request $request, $address)
  {
    $address = strtolower($address);
    $data = [
      "name" => env("APP_NAME"),
      "address" => env("ETH_ADDRESS"),
      "commission_fee" => env("CONTRACT_COMMISSION"),
      "subscription_fee" => env("SUBSCRIPTION_FEE"),
      "time" => time(),
      "paid_subscription" => env("PAID_SUBSCRIPTION"),
      "subscription" => 0,
      "balance" => Transaction::getAddressBalance($address),
    ];
    $subscription = Subscription::where("address", $address)->first();
    if ($subscription) {
      $data["subscription"] = $subscription->amount;
    }

    return $data;
  }
}
