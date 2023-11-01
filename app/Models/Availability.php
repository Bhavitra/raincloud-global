<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    use HasFactory;
     protected $fillable = [
        'title','title1', 'title2', 'start', 'end', 'teacher_id', 'status'
    ];
}
