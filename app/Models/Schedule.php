<?php

namespace App\Models;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }
}
