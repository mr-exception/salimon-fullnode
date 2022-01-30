<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateContractRequest;
use App\Http\Requests\SubmitContractResultRequest;
use App\Http\Resources\ContractResource;
use App\Models\Contract;
use App\Models\ContractReport;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContractsController extends Controller
{
  public function create(CreateContractRequest $request)
  {
    $address = getAddress();
    $fee = $request->fee;
    $count = $request->count;
    $comission = env("CONTRACT_COMISSION");
    $total_price = $fee * $count + $comission;

    $balance = Transaction::getAddressBalance($address);

    if ($balance < $total_price) {
      return abort(403, "you don't have enough balance");
    }

    $contract = new Contract();
    $contract->fill([
      "fee" => $fee,
      "total_price" => $total_price,
      "comission" => $comission,
      "type" => Contract::ADVERTISE,
      "status" => Contract::BROADCASTING,
    ]);
    $contract->count = $request->count;
    $contract->address = $address;
    $contract->file_path = Storage::disk("public")->put("/contracts", $request->file("file"));
    $contract->save();

    Transaction::create([
      "address" => $address,
      "amount" => $total_price,
      "date" => time(),
      "type" => Transaction::OUT,
      "description" => "contract " . $contract->id,
    ]);
    return ContractResource::make($contract);
  }

  public function list(Request $request)
  {
    $contracts = Contract::where(function ($query) {
      return $query;
    });
    if ($request->has("type")) {
      $contracts = $contracts->where("type", $request->type);
    }
    if ($request->has("min_fee")) {
      $contracts = $contracts->where("fee", ">", $request->min_fee);
    }
    if ($request->has("max_fee")) {
      $contracts = $contracts->where("fee", "<", $request->max_fee);
    }
    if ($request->has("min_comission")) {
      $contracts = $contracts->where("comission", ">", $request->min_comission);
    }
    if ($request->has("max_comission")) {
      $contracts = $contracts->where("comission", "<", $request->max_comission);
    }
    if ($request->has("min_total_price")) {
      $contracts = $contracts->where("total_price", ">", $request->min_total_price);
    }
    if ($request->has("max_total_price")) {
      $contracts = $contracts->where("total_price", "<", $request->max_total_price);
    }
    return ContractResource::collection($contracts);
  }

  public function submitResult(SubmitContractResultRequest $request)
  {
    $contract = Contract::Actives()
      ->where("id", $request->contract_id)
      ->firstOrFail();
    $report = ContractReport::create([
      "contract_id" => $contract->id,
      "address" => getAddress(),
      "share" => $contract->fee,
      "status" => ContractReport::VERIFIED,
    ]);
    return [
      "ok" => true,
      "ref" => $report->id,
    ];
  }
}
