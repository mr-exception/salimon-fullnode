<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\ContractReport;
use App\Models\Transaction;
use Illuminate\Http\Request;

class PublicPagesController extends Controller
{
  public function balance(Request $request, $address)
  {
    $address = strtolower($address);
    $balance = Transaction::getAddressBalance($address);
    $transactions = Transaction::where("address", $address);
    return view("balance", [
      "address" => $address,
      "balance" => $balance,
      "transactions" => $transactions
        ->orderBy("date", "desc")
        ->offset(($request->input("page", 1) - 1) * 10)
        ->limit(10)
        ->get(),
    ]);
  }
  public function contractDetails(Request $request, Contract $contract)
  {
    $reports = ContractReport::where("contract_id", $contract->id)
      ->orderBy("created_at", "desc")
      ->paginate($request->input("pageSize", 10));
    return view("contracts.detail", ["contract" => $contract, "reports" => $reports]);
  }
}
