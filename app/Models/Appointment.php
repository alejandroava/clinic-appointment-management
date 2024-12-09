<?php

namespace App\Models;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\MedicalRecords;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable =[
        'patient_id',
        'doctor_id',
        'date',
        'start_time',
        'end_time',
        'status',
        'reason'
    ];
    
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
       public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

         public function medicalRecords()
    {
        return $this->hasOne(MedicalRecords::class);
    }
}
