<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdOrderReport extends Model
{
  use HasFactory, UsesUuid;
  protected $primary = "id";
  protected $table = "ad_order_reports";
  protected $fillable = ["address", "status", "order_id"];

  public const SENT = 1;
  public const VERIFIED = 2;
  public const EXPIRED = 3;
  public const PAID = 4;

  public function getStatusStrAttribute()
  {
    return __("statics.ad_order_report.status." . $this->status);
  }

  public function order()
  {
    return $this->belongsTo(AdOrder::class, "order_id");
  }
}
