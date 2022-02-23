<?php

namespace App\Http\Controllers;

use App\Http\Requests\Signatures\CreateRequest;
use App\Http\Requests\Signatures\DestroyRequest;
use App\Http\Requests\Signatures\UpdateRequest;
use App\Models\Signature;

class SignaturesController extends Controller
{
  public function create(CreateRequest $request)
  {
    $signature = Signature::where("address", $request->address)->first();
    if ($signature) {
      return abort(401, "signature key exists");
    }

    Signature::create([
      "address" => $request->address,
      "secret" => md5($request->secret),
      "public_key" => $request->public_key,
    ]);

    return [
      "message" => "signature key created",
    ];
  }

  public function update(UpdateRequest $request)
  {
    $signature = Signature::where("address", $request->address)
      ->where("secret", md5($request->current_secret))
      ->first();
    if (!$signature) {
      return abort(401, "signature key not found");
    }

    $signature->secret = md5($request->new_secret);
    $signature->public_key = $request->publick_key;
    $signature->save();

    return [
      "message" => "signature key updated",
    ];
  }
  public function destroy(DestroyRequest $request)
  {
    $signature = Signature::where("address", $request->address)
      ->where("secret", md5($request->secret))
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
