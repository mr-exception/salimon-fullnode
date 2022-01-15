<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateContractRequest;
use App\Http\Resources\ContractResource;
use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContractsController extends Controller
{
  public function create(CreateContractRequest $request)
  {
    $contract = new Contract();
    $contract->count = $request->count;
    $contract->address = $request->address;
    $contract->file_path = Storage::disk("public")->put("/contracts", $request->file("file"));
    $contract->fee = $request->fee;
    $contract->comission = env("CONTRACT_COMMISION");
    $contract->total_price = $contract->fee * $contract->count;
    $contract->save();
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
}
