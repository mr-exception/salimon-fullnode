<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
  use HasFactory, UsesUuid;
  protected $primary = "id";
  protected $fillable = ["universal_id", "member", "key", "creator"];

  public function members()
  {
    $records = Channel::Where("universal_id", $this->universal_id)->get();
    $results = [];
    foreach ($records as $record) {
      $public_key = Signature::whereAddress($record->member)->first()->public_key;
      array_push($results, ["address" => $record->member, "public_key" => $public_key]);
    }
    return $results;
  }
}
