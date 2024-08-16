@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Datos del Archivo</h1>
    <header>
        <nav class="header2">
            Contenido del Archivo
        </nav>
    </header>
    <div class="scrollable">
        <ul>
            <table class="table table-bordered" border="1">
                <thead>
                    <tr>
                        <th>OPERACION</th>
                        <th>CICLO ESCOLAR</th>
                        <th>EF</th>
                        <th>CURP</th>     
                        <th>CLAVE PLAZA INICIO</th>
                        <th>TIPO PLAZA</th>
                        <th>NUMERO HORAS</th>
                        <th>ASIGNATURA</th>
                        <th>NIVEL SERVICIO</th>
                        <th>TIPO VALORACION</th>
                        <th>TIPO EXAMEN</th>
                        <th>PUNTUACION GLOBAL</th>
                        <th>POSICION ORDENAMIENTO</th>
                        <th>INCENTIVO ATP</th>
                        <th>INCENTIVO PFI</th>
                        <th>INCENTIVO CM</th>
                        <th>INCENTIVO PH</th>
                        <th>NOMBRE(S)</th>
                        <th>PRIMER APELLIDO</th>
                        <th>SEGUNDO APELLIDO</th>
                        <th>FUNCION</th>
                        <th>TIPO ASIGNACION</th>
                        <th>CVE PLAZA PROMOCION</th>
                        <th>CVE CATEGORIA</th>
                        <th>CCT PROMOCION</th>
                        <th>QNA INICIO</th>
                        <th>QNA TERMINO</th>
                        <th>CADUCIDAD PROMOCION</th>
                        <th>CODIGO NOMBRAMIENTO</th>
                        <th>PROMOCION</th>
                        <th>OBSERVACIONES</th>
                        <th>FECHA ALTA</th>
                        <th>MOTIVO BAJA</th>
                        <th>CLAVE ENTIDAD</th>
                    </tr>
                </thead>
                <form action="{{ route('exportar') }}" method="POST">
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->operacion }}</td>
                        <td>{{ $user->ciclo_escolar }}</td>
                        <td>{{ $user->ef }}</td>
                        <td>{{ $user->curp }}</td>
                        <td>{{ $user->cve_plaza_inicio }}</td>
                        <td>{{ $user->tipo_plaza }}</td>
                        <td>{{ $user->num_horas }}</td>
                        <td>{{ $user->asignatura }}</td>
                        <td>{{ $user->nivel_servicio }}</td>
                        <td>{{ $user->tipo_valoracion }}</td>
                        <td>{{ $user->tipo_examen }}</td>
                        <td>{{ $user->puntuacion_global }}</td>
                        <td>{{ $user->posicion_ordenamiento }}</td>
                        <td>{{ $user->incentivo_ATP }}</td>
                        <td>{{ $user->incentivo_PFI }}</td>
                        <td>{{ $user->incentivo_CM }}</td>
                        <td>{{ $user->incentivo_PH }}</td>
                        <td>{{ $user->nombres }}</td>
                        <td>{{ $user->primer_apellido }}</td>
                        <td>{{ $user->segundo_apellido }}</td>
                        <td>{{ $user->funcion }}</td>
                        <td>{{ $user->tipo_asignacion }}</td>
                        <td>{{ $user->cve_plaza_promo }}</td>
                        <td>{{ $user->cve_categoria }}</td>
                        <td>{{ $user->cct_promocion }}</td>
                        <td>{{ $user->qna_inicio }}</td>
                        <td>{{ $user->qna_termino }}</td>
                        <td>{{ $user->caducidad_promocion }}</td>
                        <td>{{ $user->codigo_nombramiento }}</td>
                        <td>{{ $user->promocion }}</td>
                        <td>{{ $user->observaciones }}</td>
                        <td>{{ $user->fecha_alta }}</td>
                        <td>{{ $user->motivo_baja }}</td>
                        <td>{{ $user->cve_entidad }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </ul>
    </div>
    <div class="go-top-container">
        <div class="go-top-button" id="scrollButton">
            <i class="fas fa-arrow-up"></i>
        </div>
    </div>
</div>
@endsection

<style>
    table {
        border-collapse: separate;
        border-spacing: 5px;
        background: rgba(73,97,91,255) bottom left repeat-x;
        color: #fff;
    }
    td, th {
        background: #fff;
        color: #000;
    }
    .scrollable {
        overflow-x: auto;
        white-space: nowrap;
    }
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }
    .go-top-container {
        position: fixed;
        bottom: 4rem;
        right: 4rem;
        width: 6.6rem;
        height: 6.6rem;
        z-index: 20;
        display: none;
    }
    .go-top-button {
        width: 6.6rem;
        height: 6.6rem;
        background: #fff;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .go-top-button i {
        font-size: 2rem;
        color: #fff;
    }
    .show {
        display: block;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    window.onscroll = function() {
        if (document.documentElement.scrollTop > 100) {
            document.querySelector('.go-top-container').classList.add('show');
        } else {
            document.querySelector('.go-top-container').classList.remove('show');
        }
    };

    document.getElementById('scrollButton').addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
});

</script>
