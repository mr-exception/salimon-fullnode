<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packet extends Model
{
  use HasFactory, UsesUuid;
  protected $primary = "id";
  protected $table = "packets";
  protected $fillable = ["data_path", "src", "dst", "msg_id", "msg_count", "position"];

  public function dataUrl()
  {
    return url($this->data_path);
  }
}
