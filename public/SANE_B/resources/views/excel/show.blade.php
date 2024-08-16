@extends('layouts.app')

@section('content')
<div class="header">
    <h1>Promoción Vertical en Educación Básica</h1>
    <div class="buttons">
    <a href="{{ route('excel.upload') }}" class="btn btn-primary volver">Volver</a>
        <a href="{{ route('excel.downloadCsv') }}" class="btn btn-primary mb-3">Descargar CSV</a>
        <form method="GET" action="{{ route('excel.searchResults', ['batchId' => $batchId]) }}" class="d-inline-block">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Buscar..." value="{{ request()->query('search') }}">
        <button type="submit" class="btn btn-primary">Buscar</button>
    </div>
        </form>
    </div>
</div>



<div class="container">
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>CICLO ESCOLAR</th>
                    <th>EF</th>
                    <th>CURP</th>
                    <th>CVE PLAZA INICIO</th>
                    <th>TIPO PLAZA</th>
                    <th>NUM HORAS</th>
                    <th>ASIGNATURA</th>
                    <th>NIVEL SERVICIO</th>
                    <th>TIPO VALORACIÓN</th>
                    <th>TIPO EXAMEN</th>
                    <th>PUNTUACIÓN GLOBAL</th>
                    <th>POSICIÓN ORDENAMIENTO</th>
                    <th>INCENTIVO ATP</th>
                    <th>INCENTIVO PFI</th>
                    <th>INCENTIVO CM</th>
                    <th>INCENTIVO PH</th>
                    <th>NOMBRE</th>
                    <th>PRIMER APELLIDO</th>
                    <th>SEGUNDO APELLIDO</th>
                    <th>FUNCIÓN</th>
                    <th>TIPO ASIGNACIÓN</th>
                    <th>CVE PLAZA PROMOCIÓN</th>
                    <th>CVE CATEGORÍA</th>
                    <th>CCT PROMOCIÓN</th>
                    <th>QNA INICIO</th>
                    <th>QNA TÉRMINO</th>
                    <th>CADUCIDAD PROMOCIÓN</th>
                    <th>CÓDIGO NOMBRAMIENTO</th>
                    <th>PROMOCIÓN</th>
                    <th>OBSERVACIONES</th>
                    <th>FECHA ALTA</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $row)
                    <tr>
                        <td>{{ $row->ciclo_escolar }}</td>
                        <td>{{ $row->ef }}</td>
                        <td>{{ $row->curp }}</td>
                        <td>{{ $row->cve_plaza_inicio }}</td>
                        <td>{{ $row->tipo_plaza }}</td>
                        <td>{{ $row->num_horas ?: '' }}</td>
                        <td>{{ $row->asignatura }}</td>
                        <td>{{ $row->nivel_servicio }}</td>
                        <td>{{ $row->tipo_valoracion }}</td>
                        <td>{{ $row->tipo_examen }}</td>
                        <td>{{ $row->puntuacion_global }}</td>
                        <td>{{ $row->posicion_ordenamiento }}</td>
                        <td>{{ $row->incentivo_atp }}</td>
                        <td>{{ $row->incentivo_pfi }}</td>
                        <td>{{ $row->incentivo_cm }}</td>
                        <td>{{ $row->incentivo_ph }}</td>
                        <td>{{ $row->nombre }}</td>
                        <td>{{ $row->primer_apellido }}</td>
                        <td>{{ $row->segundo_apellido }}</td>
                        <td>{{ $row->funcion }}</td>
                        <td>{{ $row->tipo_asignacion }}</td>
                        <td>{{ $row->cve_plaza_promocion }}</td>
                        <td>{{ $row->cve_categoria }}</td>
                        <td>{{ $row->cct_promocion }}</td>
                        <td>{{ $row->qna_inicio }}</td>
                        <td>{{ $row->qna_termino }}</td>
                        <td>{{ $row->caducidad_promocion }}</td>
                        <td>{{ $row->codigo_nombramiento }}</td>
                        <td>{{ $row->promocion }}</td>
                        <td>{{ $row->observaciones }}</td>
                        <td>{{ $row->fecha_alta }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="31">No se encontraron resultados</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
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
    }

    .buttons {
        display: flex;
        justify-content: center;
        gap: 10px;
    }

    .buttons a,
    .buttons button {
        flex: 1;
        text-align: center;
        padding: 10px 20px;
        border-radius: 5px;
        transition: background-color 0.3s, color 0.3s;
    }

    .buttons a {
        background-color: #007bff;
        color: #ffffff;
        border: 2px solid #007bff;
        text-decoration: none;
    }

    .buttons button {
        background-color: #007bff;
        color: #ffffff;
        border: 2px solid #007bff;
        cursor: pointer;
    }

    .buttons a:hover,
    .buttons button:hover {
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
        margin-top: 20px;
        border-collapse: collapse;
    }

    th, td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: center;
    }

    th {
        background-color: #f8f9fa;
        color: #343a40;
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

    .raise {
        --color: #ffa260;
        --hover: #ff6f00;
    }

    button {
        background: none;
        border: 2px solid;
        font: inherit;
        line-height: 1;
        margin: 0.5em;
        padding: 1em 2em;
        transition: 0.25s;
    }

    .raise:hover,
    .raise:focus {
        box-shadow: 0 0.5em 0.5em -0.4em var(--hover);
        transform: translateY(-0.25em);
        border-color: var(--hover);
        color: #fff;
    }

    a.volver {
        text-decoration: none;
        color: inherit;
    }
</style>
