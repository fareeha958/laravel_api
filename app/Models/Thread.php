<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasFactory;
    protected $fillable = [
        'author_id',
        'subject',
        'body',
        'replay_id',
      ];
      protected $table ='thread';

}
