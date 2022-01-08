<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
  use HasFactory, UsesUuid;
  protected $primary = "id";
  protected $table = "metas";
  protected $fillable = ["slug", "data"];

  public function scopeGetPlan($query, $value)
  {
    return $query->where("slug", "plan_$value");
  }
}
