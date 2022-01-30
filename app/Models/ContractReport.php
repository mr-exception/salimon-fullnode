<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractReport extends Model
{
  use HasFactory, UsesUuid;
  protected $primary = "id";
  protected $table = "contract_reports";
  protected $fillable = ["address", "status", "share", "contract_id"];

  public function contract()
  {
    return $this->belongsTo(Contract::class, "contract_id");
  }

  public const SENT = 1;
  public const VERIFIED = 2;
  public const EXPIRED = 3;
  public const COLLECTED = 4;
  public function getStatusStrAttribute()
  {
    return __("statics.contract_reports." . $this->status);
  }
}
