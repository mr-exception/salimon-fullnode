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
}
