<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendPacketRequest;
use App\Models\Packet;
use Illuminate\Http\Request;

class PacketsController extends Controller
{
  public function fetch(Request $request)
  {
    $packets = Packet::whereNotNull("id");
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
    return $packets->paginate($request->input("pageSize", 10));
  }
  public function send(SendPacketRequest $request)
  {
    $data = Packet::create([
      "msg_id" => $request->msg_id,
      "msg_count" => $request->msg_count,
      "data" => $request->data,
      "position" => $request->position,
      "dst" => $request->dst,
      "src" => $request->src,
    ]);
    return [
      "ok" => true,
      "data" => $data,
    ];
  }
}
