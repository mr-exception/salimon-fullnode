<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckAddressListRequest;
use App\Models\SecretKey;

class AddressController extends Controller
{
  public function checkAddressList(CheckAddressListRequest $request)
  {
    $address_list = [];
    foreach ($request->addresses as $address) {
      $address_list[strtolower($address)] = SecretKey::where("address", strtolower($address))->first() !== null;
    }
    return $address_list;
  }
}
