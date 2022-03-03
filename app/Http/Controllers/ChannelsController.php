<?php

namespace App\Http\Controllers;

use App\Http\Requests\Channels\RegisterRequest;
use App\Http\Resources\ChannelResource;
use App\Models\Channel;
use Illuminate\Http\Request;

class ChannelsController extends Controller
{
  public function register(RegisterRequest $request)
  {
    $channel = Channel::where($request->only("universal_id", "member"))->first();
    if (!$channel) {
      $channel = new Channel();
      $channel->creator = getAddress();
    } else {
      if ($channel->creator !== getAddress()) {
        return abort(403);
      }
    }
    $channel->fill($request->only("universal_id", "key", "member"));
    $channel->save();
    return ["ok" => true];
  }
  public function unregister(Request $request, $universal_id, $member)
  {
    $channel = Channel::where("universal_id", $universal_id)
      ->where("member", $member)
      ->firstOrFail();
    $address = getAddress();
    if ($channel->member === $address || $channel->creator === $address) {
      $channel->delete();
      return [
        "ok" => true,
      ];
    } else {
      return abort(403, "you can't unregister this address from channel");
    }
  }
  public function list(Request $request)
  {
    $channels = Channel::where($request->only(["universal_id", "member", "creator"]));
    return ChannelResource::collection($channels);
  }
}
