<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSignatureRequest;
use App\Http\Requests\DestroySignatureRequest;
use App\Http\Requests\UpdateSignatureRequest;
use App\Models\Signature;

class SignaturesController extends Controller
{
  public function create(CreateSignatureRequest $request)
  {
    $signature = Signature::where("address", $request->address)->first();
    if ($signature) {
      return abort(401, "signature key exists");
    }

    Signature::create([
      "address" => $request->address,
      "signature" => md5($request->signature),
      "public_key" => $request->public_key,
    ]);

    return [
      "message" => "signature key created",
    ];
  }

  public function update(UpdateSignatureRequest $request)
  {
    $signature = Signature::where("address", $request->address)
      ->where("signature", md5($request->current_signature))
      ->first();
    if (!$signature) {
      return abort(401, "signature key not found");
    }

    $signature->signature = md5($request->new_signature);
    $signature->public_key = $request->publick_key;
    $signature->save();

    return [
      "message" => "signature key updated",
    ];
  }
  public function destroy(DestroySignatureRequest $request)
  {
    $signature = Signature::where("address", $request->address)
      ->where("signature", md5($request->signature))
      ->first();
    if (!$signature) {
      return abort(401, "signature key not found");
    }
    $signature->delete();

    return [
      "message" => "signature key updated",
    ];
  }
}
