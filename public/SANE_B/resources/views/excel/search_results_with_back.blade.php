@extends('layouts.app')

@section('content')
<div class="header">
    <h1 style="background-color: #007bff; color: #ffffff; padding: 10px;">Resultados de la Búsqueda</h1>
    <a href="{{ route('excel.show', ['batchId' => $batchId]) }}" class="btn btn-primary mb-3">Regresar</a>
</div>

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if($data->isEmpty())
    <div class="container">
        <p>No se encontraron resultados para la búsqueda: "{{ request()->query('search') }}"</p>
    </div>
@else
    <div class="container">
        @foreach ($groupedData as $key => $group)
            <div class="result-group">
                @php
                    list($curp, $nombre, $primer_apellido, $segundo_apellido) = explode('-', $key);
                @endphp
                <h3>CURP: {{ $curp }} Nombre: {{ $nombre }} {{ $primer_apellido }} {{ $segundo_apellido }}</h3>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Ciclo Escolar</th>
                                <th>EF</th>
                                <th>CURP</th>
                                <th>Cve Plaza Inicio</th>
                                <th>Tipo Plaza</th>
                                <th>Num Horas</th>
                                <th>Asignatura</th>
                                <th>Nivel Servicio</th>
                                <th>Tipo Valoracion</th>
                                <th>Tipo Examen</th>
                                <th>Puntuacion Global</th>
                                <th>Posicion Ordenamiento</th>
                                <th>Incentivo ATP</th>
                                <th>Incentivo PFI</th>
                                <th>Incentivo CM</th>
                                <th>Incentivo PH</th>
                                <th>Nombre</th>
                                <th>Primer Apellido</th>
                                <th>Segundo Apellido</th>
                                <th>Funcion</th>
                                <th>Tipo Asignacion</th>
                                <th>Cve Plaza Promocion</th>
                                <th>Cve Categoria</th>
                                <th>CCT Promocion</th>
                                <th>Qna Inicio</th>
                                <th>Qna Termino</th>
                                <th>Caducidad Promocion</th>
                                <th>Codigo Nombramiento</th>
                                <th>Promocion</th>
                                <th>Observaciones</th>
                                <th>Fecha Alta</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($group as $item)
                                <tr>
                                    <td>{{ $item->ciclo_escolar }}</td>
                                    <td>{{ $item->ef }}</td> 
                                    <td>{{ $item->curp }}</td>
                                    <td>{{ $item->cve_plaza_inicio }}</td>
                                    <td>{{ $item->tipo_plaza }}</td>
                                    <td>{{ $item->num_horas }}</td>
                                    <td>{{ $item->asignatura }}</td>
                                    <td>{{ $item->nivel_servicio }}</td>
                                    <td>{{ $item->tipo_valoracion }}</td>
                                    <td>{{ $item->tipo_examen }}</td>
                                    <td>{{ $item->puntuacion_global }}</td>
                                    <td>{{ $item->posicion_ordenamiento }}</td>
                                    <td>{{ $item->incentivo_atp }}</td>
                                    <td>{{ $item->incentivo_pfi }}</td>
                                    <td>{{ $item->incentivo_cm }}</td>
                                    <td>{{ $item->incentivo_ph }}</td>
                                    <td>{{ $item->nombre }}</td>
                                    <td>{{ $item->primer_apellido }}</td>
                                    <td>{{ $item->segundo_apellido }}</td>
                                    <td>{{ $item->funcion }}</td>
                                    <td>{{ $item->tipo_asignacion }}</td>
                                    <td>{{ $item->cve_plaza_promocion }}</td>
                                    <td>{{ $item->cve_categoria }}</td>
                                    <td>{{ $item->cct_promocion }}</td>
                                    <td>{{ $item->qna_inicio }}</td>
                                    <td>{{ $item->qna_termino }}</td>
                                    <td>{{ $item->caducidad_promocion }}</td>
                                    <td>{{ $item->codigo_nombramiento }}</td>
                                    <td>{{ $item->promocion }}</td>
                                    <td>{{ $item->observaciones }}</td>
                                    <td>{{ $item->fecha_alta }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection

<style>
    body {
        background-color: #ffffff;
        color: #343a40;
        font-family: Arial, sans-serif;
    }

    .header {
        background-color: #007bff;
        color: #ffffff;
        padding: 20px;
        text-align: center;
    }

    .header h1 {
        margin: 0;
        font-size: 24px;
        background-color: #007bff;
        color: #ffffff;
        padding: 10px;
        border-radius: 5px;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        color: #ffffff;
        text-decoration: none;
        padding: 10px 20px;
        border-radius: 5px;
        transition: background-color 0.3s, color 0.3s;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .container {
        margin: 20px;
        padding: 20px;
        background-color: #ffffff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        overflow-x: auto;
        overflow-y: auto;
        max-height: 80vh;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        padding: 10px;
        border: 1px solid #dee2e6;
        text-align: left;
    }

    th {
        background-color: #007bff;
        color: #ffffff;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #e2e2e2;
    }

    .alert {
        padding: 15px;
        background-color: #f44336;
        color: white;
        margin-bottom: 20px;
    }

    .alert-danger {
        background-color: #f44336;
    }

    .result-group {
        margin-bottom: 30px;
    }

    .result-group h3 {
        background-color: #343a40;
        color: #ffffff;
        padding: 10px;
        border-radius: 5px;
    }
</style>
