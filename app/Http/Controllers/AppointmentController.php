<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
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

        $patient = Auth::user();
       

        $doctors = Doctor::with('user')->where('status', 'available')->get()->map(function($doctor){
            return [
                'id' => $doctor->id,
                'name' => $doctor->user->name . ' ' . $doctor->user->lastname
            ];
        });

        return view('pages.appointment.create',[
            'patient' => $patient,
            'doctors' => $doctors
        ]);
    }

    public function getAvailableDates (Request $request)
    {
        $doctor = Doctor::findOrFail($request->doctor_id);

        $availableDates = $this->getAvailableDatesForDoctor($doctor);

        return response()->json($availableDates);
    }

    public function getAvailableDatesForDoctor()
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
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
}
