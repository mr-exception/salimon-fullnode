<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
  use HasFactory, UsesUuid;
  protected $primary = "id";
  protected $table = "transactions";
  protected $fillable = ["address", "date", "amount", "price"];
}
