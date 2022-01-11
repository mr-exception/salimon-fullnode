<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdOrder extends Model
{
  use HasFactory, UsesUuid;
  protected $primary = "id";
  protected $table = "ad_orders";
  protected $fillable = ["address", "status", "price", "count", "data_path", "size"];

  public const PENDING = 1;
  public const PAID = 2;
  public const BROADCASTING = 3;
  public const FINISHED = 4;

  public function getStatusStrAttribute()
  {
    return __("statics.ad_order.status." . $this->status);
  }

  public function reports()
  {
    return $this->hasMany(AdOrderReport::class, "order_id");
  }
}
