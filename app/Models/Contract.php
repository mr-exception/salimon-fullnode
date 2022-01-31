<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Contract extends Model
{
  use HasFactory, UsesUuid;
  protected $primary = "id";
  protected $table = "contracts";
  protected $fillable = ["address", "price", "file_path", "count", "type", "total_price", "commission", "fee", "status"];

  public const PENDING = 1;
  public const PAID = 2;
  public const BROADCASTING = 3;
  public const FINISHED = 4;

  public function scopeActives($query)
  {
    return $query->where("status", Contract::BROADCASTING);
  }

  public function getStatusStrAttribute()
  {
    return __("statics.contracts.status." . $this->status);
  }

  public const ADVERTISE = 1;
  public const PLAIN_REQUEST = 2;

  public function getTypeStrAttribute()
  {
    return __("statics.contracts.type." . $this->type);
  }

  public function reports()
  {
    return $this->hasMany(ContractReport::class, "contract_id");
  }

  public function fileUrl()
  {
    return Storage::disk("public")->url($this->file_path);
  }
}
