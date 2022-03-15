<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Packet extends Model
{
  use HasFactory, UsesUuid;
  protected $primary = "id";
  protected $table = "packets";
  protected $fillable = ["data_path", "src", "dst", "msg_id", "msg_count", "position"];

  public function dataUrl()
  {
    return Storage::disk("public")->url($this->data_path);
  }
  public function data()
  {
    return Storage::disk("public")->get($this->data_path);
  }
}
