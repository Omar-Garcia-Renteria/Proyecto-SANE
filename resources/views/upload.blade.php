@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html>
<head>
    <title>Subir Archivos</title>
</head>
<body>

    <header>
    <nav class="header2">
    
    Generar Archivo para la Plataforma SANE - Ciclo Escolar: {{ date('Y') }}-{{ date('Y') + 1 }}
    
</nav>
    </header >

    <h1 style="text-align:center;" >Combinar archivos Excel (Xlsx)</h1>
    <table border="1" style="margin: 0 auto;">
        <tr>
            <td>
    <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="file1" >Listas:</label>
        <input type="file" name="file1" required ><br>

        <label for="file2" >Reporte:</label>
        <input type="file" name="file2" required ><br>

        <label for="filename">Nombre del Archivo:</label>
        <input type="text" name="filename" required><br>

        <button type="submit" class="btn success animated-button"> <span> Combinar y Descargar</span></button>

        
    </form>
    </td>
    </tr>
    </table>
    
</body>
</html>
@endsection

<style>
    table {
   border-collapse: separate;
   border-spacing: 5px;
   background: rgba(73,97,91,255) url("gradient.gif") bottom left repeat-x;
   color: #fff;
}
td, th {
   background: #fff;
   color: #000;
}
</style>