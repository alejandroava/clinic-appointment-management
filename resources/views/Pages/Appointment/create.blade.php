@extends('adminlte::page')

@section('content')
<div class="container">
    <h2>Agendar Nueva Cita</h2>
    <form id="appointment-form" action="{{ route('appointment.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label>Paciente</label>
            <input type="text" class="form-control" value="{{ $patient->name  ?? 'Sin nombre'}}" readonly>
        </div>

        <div class="form-group">
            <label>Doctor</label>
            <select name="doctor_id" id="doctor" class="form-control" required>
                <option value="">Seleccione un doctor</option>
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor['id'] }}">{{ $doctor['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Fecha</label>
            <select name="date" id="date" class="form-control" required disabled>
                <option value="">Seleccione primero un doctor</option>
            </select>
        </div>

        <div class="form-group">
            <label>Hora de Inicio</label>
            <select name="start_time" id="start_time" class="form-control" required disabled>
                <option value="">Seleccione primero una fecha</option>
            </select>
        </div>

        <div class="form-group">
            <label>Razón de Consulta</label>
            <select name="reason" class="form-control">
                <option value="consulta general">Consulta General</option>
                <option value="seguimiento">Seguimiento</option>
                <option value="control">Control</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Agendar Cita</button>
    </form>
</div>
@endsection

@section('js')
<script>
$(document).ready(function() {
    $('#doctor').change(function() {
        const doctorId = $(this).val();
        
        // Habilitar y cargar fechas
        $('#date').prop('disabled', false).html('<option>Cargando fechas...</option>');
        
        $.ajax({
            url: '{{route('appointments.available-dates')}}',
            method: 'GET',
            data: { doctor_id: doctorId },
            success: function(dates) {
                let options = '<option value="">Seleccione una fecha</option>';
                dates.forEach(function(date) {
                    options += `<option value="${date}">${date}</option>`;
                });
                $('#date').html(options);
            }
        });
    });

    $('#date').change(function() {
        const doctorId = $('#doctor').val();
        const date = $(this).val();
        
        // Habilitar y cargar horas
        $('#start_time').prop('disabled', false).html('<option>Cargando horas...</option>');
        
        $.ajax({
            url: '{{route('appointments.available-time')}}',
            method: 'GET',
            data: { 
                doctor_id: doctorId,
                date: date 
            },
            success: function(times) {
                let options = '<option value="">Seleccione una hora</option>';
                times.forEach(function(time) {
                    options += `<option value="${time}">${time}</option>`;
                });
                $('#start_time').html(options);
            }
        });
    });
});
</script>
@endsection