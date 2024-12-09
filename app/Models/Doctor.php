<?php

namespace App\Models;

use App\Models\User;
use App\Models\Schedule;
use App\Models\Appointment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doctor extends Model
{

    use HasFactory;

    protected $fillable = [
        'user_id',
        'schedule_id',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
