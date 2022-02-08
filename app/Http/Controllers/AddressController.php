<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckAddressListRequest;
use App\Models\Signature;

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
}
