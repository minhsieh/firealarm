<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alarm extends Model
{
    protected $fillable = [
        'time',
        'type',
        'team',
        'status',
        'location',
        'publish_at'
    ];
}
