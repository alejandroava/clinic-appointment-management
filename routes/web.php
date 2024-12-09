<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PatientController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

Route::group(['prefix' => 'paciente'],function(){
    Route::get('/dashboard',[PatientController::class, 'dashboard'])->name('patient.dasboard');
    Route::get('/pedir-cita',[AppointmentController::class,'create'])->name('appointment.create');
    Route::get('/fechas-disponibles', [AppointmentController::class, 'getAvailableDates'])->name('appointments.available-dates');
    Route::get('horas-disponibles',[AppointmentController::class, 'getAvailableTimeSlots'])->name('appointments.available-time');
    Route::post('/pedir-cita',[AppointmentController::class,'store'])->name('appointment.store');
    // Route::get('/api/doctors/{doctor}/dates', [AppointmentController::class, 'availableDates']);
});
