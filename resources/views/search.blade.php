@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html>
<head>
    <title>Buscar por CURP</title>
</head>
<body>
    

    @if(isset($user))
        <h1>Datos del usuario: </h1>

        <header>
    <nav class="header2">
        Datos del usuario buscado
    </nav>
    </header>

         <h2><strong>CURP:</strong> {{$user->curp}} <br>
         <strong>NOMBRE: </strong> {{$user->nombres}} {{$user->primer_apellido}} {{$user->segundo_apellido}} </h2>
        <ul>
            <li><strong> NOMBRE:</strong> {{ $user->nombres }}</li>
            <li><strong>PRIMER APELLIDO:</strong> {{ $user->primer_apellido }}</li>
            <li><strong>SEGUNDO APELLIDO: </strong>{{ $user->segundo_apellido }}</li>
            <li><strong>CURP: </strong>{{ $user->curp }}</li>
            <li><strong>FOLIO: </strong>{{ $user->folio }}</li>
            <li><strong>EF: </strong>{{ $user->ef }}</li>
            <li><strong>CVE_ENTIDAD: </strong>{{ $user->cve_entidad }}</li>
            <li><strong>QNA_INICIO: </strong>{{ $user->qna_inicio }}</li>
            <li><strong>CVE_PLAZA_INICIO: </strong>{{ $user->cve_plaza_inicio }}</li>
            <li><strong>TIPO_PLAZA: </strong>{{ $user->tipo_plaza }}</li>
            <li><strong>NUM HORAS: </strong>{{ $user->num_horas }}</li>
            <li><strong>ASIGNATURA: </strong>{{ $user->asignatura }}</li>
            <li><strong>NIVEL_SERVICIO: </strong>{{ $user->nivel_servicio }}</li>
            <li><strong>TIPO_VALORACION: </strong>{{ $user->tipo_valoracion }}</li>
            <li><strong>TIPO_EXAMEN: </strong>{{ $user->tipo_examen }}</li>
            <li><strong>PUNTUACION_GLOBAL: </strong>{{ $user->puntuacion_global }}</li>
            <li><strong>POSICION_ORDENAMIENTO: </strong>{{ $user->posicion_ordenamiento }}</li>
            <li><strong>INCENTIVO_ATP: </strong>{{ $user->incentivo_ATP }}</li>
            <li><strong>INCENTIVO_PFI: </strong>{{ $user->incentivo_PFI }}</li>
            <li><strong>INCENTIVO_CM: </strong>{{ $user->incentivo_CM }}</li>
            <li><strong>INCENTIVO_PH: </strong>{{ $user->incentivo_PH }}</li>
            <li><strong>FUNCION: </strong>{{ $user->funcion }}</li>
            <li><strong>TIPO_ASIGNACION: </strong>{{ $user->tipo_asignacion }}</li>
            <li><strong>CVE_PLAZA_PROMO: </strong>{{ $user->cve_plaza_promo }}</li>
            <li><strong>CVE_CATEGORIA: </strong>{{ $user->cve_categoria }}</li>
            <li><strong>CCT_PROMOCION: </strong>{{ $user->cct_promocion }}</li>
            <li><strong>QNA_TERMINO: </strong>{{ $user->qna_termino }}</li>
            <li><strong>CADUCIDAD_PROMOCION: </strong>{{ $user->caducidad_promocion }}</li>
            <li><strong>CODIGO_NOMBRAMIENTO: </strong>{{ $user->codigo_nombramiento }}</li>
            <li><strong>PROMOCION: </strong>{{ $user->promocion }}</li>
            <li><strong>MOTIVO_BAJA: </strong>{{ $user->motivo_baja }}</li>
            <li><strong>OBSERVACIONES: </strong>{{ $user->observaciones }}</li>
            


            <form action="{{ route('exportar') }}" method="POST">
                
            @csrf
            <input type="hidden" name="curp" value="{{ $user->curp }}">
            <input type="hidden" name="name" value="{{ $user->nombres }}">
            <input type="hidden" name="primer_apellido" value="{{ $user->primer_apellido }}">
            <input type="hidden" name="segundo_apellido" value="{{ $user->segundo_apellido }}">
            <input type="hidden" name="folio" value="{{ $user->folio }}">
            <input type="hidden" name="ef" value="{{ $user->ef }}">
            <input type="hidden" name="cve_entidad" value="{{ $user->cve_entidad }}">
            <input type="hidden" name="qna_inicio" value="{{ $user->qna_inicio }}">
            <input type="hidden" name="cve_plaza_inicio" value="{{ $user->cve_plaza_inicio }}">
            <input type="hidden" name="tipo_plaza" value="{{ $user->tipo_plaza }}">
            <input type="hidden" name="num_horas" value="{{ $user->num_horas }}">
            <input type="hidden" name="asignatura" value="{{ $user->asignatura }}">
            <input type="hidden" name="nivel_servicio" value="{{ $user->nivel_servicio }}">
            <input type="hidden" name="tipo_valoracion" value="{{ $user->tipo_valoracion }}">
            <input type="hidden" name="tipo_examen" value="{{ $user->tipo_examen }}">
            <input type="hidden" name="puntuacion_global" value="{{ $user->puntuacion_global }}">
            <input type="hidden" name="posicion_ordenamiento" value="{{ $user->posicion_ordenamiento }}">
            <input type="hidden" name="incentivo_atp" value="{{ $user->incentivo_ATP }}">
            <input type="hidden" name="incentivo_pfi" value="{{ $user->incentivo_PFI }}">
            <input type="hidden" name="incentivo_cm" value="{{ $user->incentivo_CM }}">
            <input type="hidden" name="incentivo_ph" value="{{ $user->incentivo_PH }}">
            <input type="hidden" name="funcion" value="{{ $user->funcion }}">
            <input type="hidden" name="tipo_asignacion" value="{{ $user->tipo_asignacion }}">
            <input type="hidden" name="cve_plaza_promo" value="{{ $user->cve_plaza_promo }}">
            <input type="hidden" name="cve_categoria" value="{{ $user->cve_categoria }}">
            <input type="hidden" name="cct_promocion" value="{{ $user->cct_promocion }}">
            <input type="hidden" name="qna_termino" value="{{ $user->qna_termino }}">
            <input type="hidden" name="caducidad_promocion" value="{{ $user->caducidad_promocion }}">
            <input type="hidden" name="codigo_nombramiento" value="{{ $user->codigo_nombramiento }}">
            <input type="hidden" name="promocion" value="{{ $user->promocion }}">
            <input type="hidden" name="motivo_baja" value="{{ $user->motivo_baja }}">
            <input type="hidden" name="observaciones" value="{{ $user->observaciones }}">
            
            <button type="submit" class="btn success animated-button"><span>Descargar Información del Usuario</span></button>
        </form>
            
        </ul>
        
    @elseif(isset($error))
        <p>{{ $error }}</p>
    @endif

    
</body>
</html>
@endsection