<?php

namespace App\Http\Resources;

class ChannelResource extends Resource
{
  public function toArray($request)
  {
    $data = [
      "universal_id" => $this->universal_id,
      "creator" => $this->creator,
      "members" => $this->members(),
      "key" => $this->key,
    ];
    return $this->withDates($data);
  }
}
