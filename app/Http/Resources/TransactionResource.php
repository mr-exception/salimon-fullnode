<?php

namespace App\Http\Resources;

class TransactionResource extends Resource
{
  public function toArray($request)
  {
    $data = [
      "id" => $this->id,
    ];
    return $this->withDates($data);
  }
}
