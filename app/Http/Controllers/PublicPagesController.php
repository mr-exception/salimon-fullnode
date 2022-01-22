<?php

namespace App\Http\Controllers;

use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use Illuminate\Http\Request;

class PublicPagesController extends Controller
{
  public function address(Request $request, $address)
  {
    $address = strtolower($address);
    $balance = Transaction::getAddressBalance($address);
    $transactions = Transaction::where("address", $address);
    return view("address", [
      "address" => $address,
      "balance" => $balance,
      "transactions" => $transactions
        ->offset(($request->input("page", 1) - 1) * 10)
        ->limit(10)
        ->get(),
    ]);
  }
}
