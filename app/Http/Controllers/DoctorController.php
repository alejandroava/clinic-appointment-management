<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class DoctorController extends Controller
{

    public function dashboard()
    {

          if (Auth::user()->role === 'doctor') {
            Config::set('adminlte.sidebar', [
                ['text' => 'Pacientes', 'url' => 'doctor/pacientes', 'icon' => 'fas fa-user-injured'],
                ['text' => 'Horarios', 'url' => 'doctor/horarios', 'icon' => 'fas fa-clock'],
            ]);
        } elseif (Auth::user()->role === 'patient') {
            Config::set('adminlte.sidebar', [
                ['text' => 'Pedir Cita', 'url' => 'paciente/pedir-cita', 'icon' => 'fas fa-calendar-plus'],
                ['text' => 'Citas Activas', 'url' => 'paciente/citas-activas', 'icon' => 'fas fa-calendar-check'],
                ['text' => 'Historial de Citas', 'url' => 'paciente/historial-citas', 'icon' => 'fas fa-history'],
            ]);
        }
        return view('pages.doctor.dashboard');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doctor $doctor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doctor $doctor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        //
    }
}
