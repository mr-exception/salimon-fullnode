<?php

namespace App\Http\Resources;

class ChannelResource extends Resource
{
  public function toArray($request)
  {
    $data = [
      "id" => $this->id,
      "universal_id" => $this->universal_id,
      "creator" => $this->creator,
      "member" => $this->member,
      "key" => $this->key,
    ];

    return $this->withDates($data);
  }
}
