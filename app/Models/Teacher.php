<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Country;

class Teacher extends Model
{
    use HasFactory;

    public function country(){

        return $this->hasOne(Country::class);
    }
}
