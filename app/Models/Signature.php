<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signature extends Model
{
  use HasFactory, UsesUuid;
  protected $primary = "id";
  protected $table = "signatures";
  protected $fillable = ["address", "secret", "public_key"];
}
