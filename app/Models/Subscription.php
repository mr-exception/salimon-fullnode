<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
  use HasFactory, UsesUuid;
  protected $primary = "id";
  protected $table = "subscriptions";
  protected $fillable = ["address", "amount"];
}
