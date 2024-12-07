<?php

namespace App\Models;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Model;

class MedicalRecords extends Model
{
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

}
