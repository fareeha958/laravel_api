<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Replay extends Model
{
    use HasFactory;
    protected $fillable = [
        'body',
        'author_id',
        'replayble_id',
        'posted_at',
        'created_at',
        'updated_at'
      ];
}
