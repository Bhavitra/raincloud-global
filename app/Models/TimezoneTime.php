<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeZoneTime extends Model
{
    use HasFactory;
    protected $table = 'timezone_times';
    public $timestamps = false;
}
