<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
  use HasFactory, UsesUuid;
  protected $primary = "id";
  protected $table = "transactions";
  protected $fillable = ["address", "date", "amount", "type", "description"];

  public const IN = 1;
  public const OUT = 2;

  public function getTypeStrAttribute()
  {
    return __("statics.transactions.type." . $this->type);
  }

  public function getAmountStrAttribute()
  {
    return $this->amount . " gwei";
  }

  public function getDateObjectAttribute()
  {
    return Carbon::createFromTimestamp($this->date);
  }

  public function getFormattedDateAttribute()
  {
    return $this->date_object->format("Y-m-d H:i");
  }

  public static function getAddressBalance($address)
  {
    $in = Transaction::where("address", $address)
      ->where("type", Transaction::IN)
      ->sum("amount");
    $out = Transaction::where("address", $address)
      ->where("type", Transaction::OUT)
      ->sum("amount");
    return $in - $out;
  }
}
