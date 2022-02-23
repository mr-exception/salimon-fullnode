<?php

namespace App\Http\Controllers;

use App\Http\Requests\Packets\SendRequest;
use App\Http\Resources\PacketResource;
use App\Models\Packet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PacketsController extends Controller
{
  public function fetch(Request $request)
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
    if ($request->has("thread")) {
      $packets = $packets->where(function ($query) use ($request) {
        return $query->where("src", $request->thread)->orWhere("dst", $request->thread);
      });
    }
    if ($request->has("date_from")) {
      $packets = $packets->where("created_at", ">", $request->date_from);
    }
    if ($request->has("date_to")) {
      $packets = $packets->where("created_at", ">", $request->date_to);
    }
    return PacketResource::collection($packets);
  }
  public function send(SendRequest $request)
  {
    $data = Packet::create([
      "msg_id" => $request->msg_id,
      "msg_count" => $request->msg_count,
      "data_path" => "/fake.data",
      "position" => $request->position,
      "type" => $request->type,
      "dst" => $request->dst,
      "src" => getAddress(),
    ]);
    Storage::disk("public")->put("/packets/$data->id.data", $request->data);
    $data->data_path = "/packets/$data->id.data";
    $data->save();
    return [
      "ok" => true,
      "data" => PacketResource::make($data),
    ];
  }
}
