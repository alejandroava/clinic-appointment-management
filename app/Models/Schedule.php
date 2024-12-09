<?php

namespace App\Models;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{

    use HasFactory;

    protected $fillable = [
        'days_of_week',
        'start_time',
        'end_time'
    ];

    
    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }
}
