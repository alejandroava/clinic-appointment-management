<?php

namespace App\Models;

use App\Models\User;
use App\Models\Schedule;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function appointment()
    {
        return $this->hasOne(Appointment::class);
    }
}
