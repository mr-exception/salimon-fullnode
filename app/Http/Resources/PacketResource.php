<?php

namespace App\Http\Resources;

class PacketResource extends Resource
{
  public function toArray($request)
  {
    $data = [
      "id" => $this->id,
      "src" => $this->src,
      "dst" => $this->dst,
      "data" => $this->data(),
      "msg_id" => $this->msg_id,
      "msg_count" => $this->msg_count,
      "position" => $this->position,
      "created_at" => $this->created_at,
    ];

    return $this->withDates($data);
  }
}
