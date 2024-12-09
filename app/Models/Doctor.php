<?php

namespace App\Models;

use App\Models\User;
use App\Models\Schedule;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{

    use HasFactory;

    protected $fillable = [
        'user_id',
        'sheduled_id',
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

    public function appointment()
    {
        return $this->hasOne(Appointment::class);
    }
}
