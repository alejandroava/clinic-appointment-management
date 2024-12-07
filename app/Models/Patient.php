<?php

namespace App\Models;

use App\Models\MedicalRecords;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function medicalHistory()
    {
        return $this->hasOne(MedicalRecords::class);
    }

       public function appointment()
    {
        return $this->hasOne(Appointment::class);
    }
}
