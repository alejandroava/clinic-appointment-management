<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use Carbon\Carbon;
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



    public function getAvailableDatesForDoctor($doctor)
    {
        if (!$doctor->schedule) {
        return []; // Sin fechas disponibles
    }

    $availableDates = [];
    $currentDate = Carbon::now();
    $daysAhead = 14; // Días para buscar disponibilidad

    // Obtener días laborales del doctor
    $workDays = explode(',', $doctor->schedule->days_of_week);
    
    for ($i = 0; $i < $daysAhead; $i++) {
        $date = $currentDate->copy()->addDays($i);
        $dayOfWeek = $this->convertDayToSpanish($date->format('l')); // Convierte al formato de la base de datos
        
        if (in_array($dayOfWeek, $workDays)) {
            $availableDates[] = $date->toDateString();
        }
    }

    return $availableDates;
    }

    public function getAvailableTimeSlots(Request $request)
    {
        $doctor = Doctor::findOrFail($request->doctor_id);
        $date = $request->date;

        $availableTimeSlots = $this->getAvailableTimeSlotsForDoctorAndDate($doctor, $date);

        return response()->json($availableTimeSlots);
    }

    public function getAvailableTimeSlotsForDoctorAndDate($doctor,$date)
    {
        if(!$doctor->schedule)
        {
            return [];
        }

        $dayOfWeek = $this->convertDayToSpanish(Carbon::parse($date)->format('l'));
        \Log::info($dayOfWeek);

        $workDays = explode(',', $doctor->schedule->days_of_week);

        if(!in_array($dayOfWeek, $workDays)){
            return [];
        }
        \Log::info($dayOfWeek);

        $scheduleStart = Carbon::parse($doctor->schedule->start_time);
        $scheduleEnd = Carbon::parse($doctor->schedule->end_time);
        $appointmentDuration = 30; // Duración de cada cita en minutos
        $availableTimeSlots = [];

        while ($scheduleStart->lt($scheduleEnd)) {
        $slotStart = $scheduleStart->copy();
        $slotEnd = $scheduleStart->copy()->addMinutes($appointmentDuration);

        // Verificar si el intervalo está libre
        if ($this->isTimeSlotAvailableForDoctor($doctor, $date, $slotStart->format('H:i:s'), $slotEnd->format('H:i:s'))) {
            $availableTimeSlots[] = $slotStart->format('H:i:s');
        }

        $scheduleStart->addMinutes($appointmentDuration);
    }

    return $availableTimeSlots;
    }

    private function isTimeSlotAvailableForDoctor($doctor, $date, $startTime, $endTime)
{

    \Log::info('Fecha: ' . $date . ', Hora inicio: ' . $startTime . ', Hora fin: ' . $endTime);
    return !$doctor->appointments()
        ->whereDate('date', $date)
        ->where(function ($query) use ($startTime, $endTime) {
            $query->whereBetween('start_time', [$startTime, $endTime])
                  ->orWhereBetween('end_time', [$startTime, $endTime]);
        })
        ->exists();
}

    private function convertDayToSpanish($day)
    {
        // Mapeo de días de la semana en inglés a español
        $days = [
            'Monday' => 'Lunes',
            'Tuesday' => 'Martes',
            'Wednesday' => 'Miércoles',
            'Thursday' => 'Jueves',
            'Friday' => 'Viernes',
            'Saturday' => 'Sábado',
            'Sunday' => 'Domingo',
        ];

        // Devolver el nombre del día en español o el mismo valor si no se encuentra
        return $days[$day] ?? $day;
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'date' => 'required|date|after:today',
            'start_time' => 'required|date_format:H:i:s',
        ]);

        $patient = Auth::user();

        $appointment = Appointment::create([
            'patient_id' => $patient->id,
            'doctor_id' => $validatedData['doctor_id'],
            'date' => $validatedData['date'],
            'start_time' => $validatedData['start_time'],
            'end_time' => Carbon::parse($validatedData['start_time'])->addMinutes(30)->format('H:i'),
            'status' => 'scheduled',
            'reason' => $request->reason ?? 'consulta general'
        ]);

        return redirect()->route('appointment.create')->with('success', 'Cita agendada exitosamente');
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
