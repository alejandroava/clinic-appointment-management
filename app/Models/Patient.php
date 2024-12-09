<?php

namespace App\Models;

use App\Models\MedicalRecords;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{

    use HasFactory;

    protected $fillable = [
        'user_id',
        'blood_group'
    ];
    
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
        return $this->hasMany(Appointment::class);
    }
}
