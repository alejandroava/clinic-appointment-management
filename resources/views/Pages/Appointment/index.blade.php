@extends('adminlte::page')

@section('title', 'Citas Activas')

@section('content_header')
    <h1>Citas Activas</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Citas Programadas</h3>
        </div>
        <div class="card-body">
            @if($appointments->isEmpty())
                <p class="text-center">No hay citas activas en este momento.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>Doctor</th>
                                <th>Paciente</th>
                                <th>Fecha</th>
                                <th>Hora Inicio</th>
                                <th>Hora Final</th>
                                <th>Estado</th>
                                <th>Razón</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appointments as $appointment)
                                <tr>
                                    <td>{{ $appointment->doctor->user->name ?? 'Sin asignar' }}</td>
                                    <td>{{ $appointment->patient->user->name ?? 'Sin asignar' }}</td>
                                    <td>{{ $appointment->date }}</td>
                                    <td>{{ \Carbon\Carbon::parse($appointment->start_time)->format('H:i') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($appointment->end_time)->format('H:i') }}</td>
                                    <td>
                                        <span class="badge badge-success">
                                            {{ ucfirst($appointment->status) }}
                                        </span>
                                    </td>
                                    <td>{{ ucfirst($appointment->reason) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
        <div class="card-footer">
            {{--  {{ $appointments->links() }} Paginate links  --}}
        </div>
    </div>
@stop

@section('css')
    <style>
        .table-responsive {
            overflow-x: auto;
        }
        .badge-success {
            background-color: #28a745;
        }
    </style>
@stop

@section('js')
    <script> console.log('Citas activas cargadas con éxito.'); </script>
@stop
