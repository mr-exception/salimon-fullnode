<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSecretKeyRequest;
use App\Http\Requests\DestroySecretKeyRequest;
use App\Http\Requests\UpdateSecretKeyRequest;
use App\Models\SecretKey;

class SecretsController extends Controller
{
  public function create(CreateSecretKeyRequest $request)
  {
    $secret = SecretKey::where("address", $request->address)->first();
    if ($secret) {
      return abort(401, "secret key exists");
    }

    SecretKey::create([
      "address" => $request->address,
      "secret" => md5($request->secret),
    ]);

    return [
      "message" => "secret key created",
    ];
  }

  public function update(UpdateSecretKeyRequest $request)
  {
    $secret = SecretKey::where("address", $request->address)
      ->where("secret", md5($request->current_secret))
      ->first();
    if (!$secret) {
      return abort(401, "secret key not found");
    }

    $secret->secret = md5($request->new_secret);
    $secret->save();

    return [
      "message" => "secret key updated",
    ];
  }
  public function destroy(DestroySecretKeyRequest $request)
  {
    $secret = SecretKey::where("address", $request->address)
      ->where("secret", md5($request->secret))
      ->first();
    if (!$secret) {
      return abort(401, "secret key not found");
    }
    $secret->delete();

    return [
      "message" => "secret key updated",
    ];
  }
}
