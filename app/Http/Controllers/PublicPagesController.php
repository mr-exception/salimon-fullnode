<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\ContractReport;
use App\Models\Packet;
use App\Models\Subscription;
use App\Models\Transaction;
use Illuminate\Http\Request;

class PublicPagesController extends Controller
{
  public function balance(Request $request, $address)
  {
    $address = strtolower($address);
    $balance = Transaction::getAddressBalance($address);
    $transactions = Transaction::where("address", $address);
    $subscription = Subscription::where("address", $address)->first();
    $packet_balance = 0;
    if ($subscription) {
      $packet_balance = $subscription->amount;
    }
    return view("balance", [
      "address" => $address,
      "balance" => $balance,
      "packet_balance" => $packet_balance,
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
  public function contractsList(Request $request)
  {
    $contracts = Contract::where(function ($query) {
      return $query;
    });
    return view("contracts.list", ["contracts" => $contracts->paginate($request->input("pageSize", 10))]);
  }

  public function packetsList(Request $request)
  {
    $packets = Packet::where(function ($query) {
      return $query;
    });
    if ($request->has("msg_id")) {
      $packets = $packets->where("msg_id", $request->msg_id);
    }
    if ($request->has("position")) {
      $packets = $packets->where("position", $request->position);
    }
    if ($request->has("dst")) {
      $packets = $packets->where("dst", $request->dst);
    }
    if ($request->has("src")) {
      $packets = $packets->where("src", $request->src);
    }
    if ($request->has("date_from")) {
      $packets = $packets->where("created_at", ">", $request->date_from);
    }
    if ($request->has("date_to")) {
      $packets = $packets->where("created_at", ">", $request->date_to);
    }
    return view("packets.list", ["packets" => $packets->paginate($request->input("pageSize", 10))]);
  }

  public function packetDetails(Request $request, Packet $packet)
  {
    $message_packets = Packet::where("msg_id", $packet->msg_id)->get();
    return view("packets.detail", ["packet" => $packet, "message_packets" => $message_packets]);
  }
}
