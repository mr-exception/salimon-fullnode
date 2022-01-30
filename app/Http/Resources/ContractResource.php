<?php

namespace App\Http\Resources;

class ContractResource extends Resource
{
  public function toArray($request)
  {
    $data = [
      "id" => $this->id,
      "file" => $this->fileUrl(),
      "count" => $this->count,
      "fee" => $this->fee,
      "commission" => $this->commission,
      "total_price" => $this->total_price,
      "type" => $this->type,
      "status" => $this->status,
    ];

    return $this->withDates($data);
  }
}
