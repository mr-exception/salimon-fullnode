<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecretKey extends Model
{
  use HasFactory, UsesUuid;
  protected $primary = "id";
  protected $table = "secret_keys";
  protected $fillable = ["address", "secret"];
}
