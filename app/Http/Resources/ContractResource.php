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
      "comission" => $this->comission,
      "total_price" => $this->total_price,
      "type" => $this->type_str,
      "status" => $this->status_str,
    ];

    return $this->withDates($data);
  }
}
