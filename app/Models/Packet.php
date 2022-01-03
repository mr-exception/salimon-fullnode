<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packet extends Model
{
    use HasFactory, UsesUuid;
    protected $table = 'packets';
    protected $fillable = ['data', 'fetched', 'src', 'dst', 'msg_id', 'msg_count','position', 'date'];
}
