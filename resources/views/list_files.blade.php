@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Archivos Importados</title>
</head>
<body>
<header class="header2">
    <nav>
          Lista de archivos importados
    </nav>
</header>

<h1 style="text-align:center;">Archivos Importados</h1>

<form action="{{ route('searchfile') }}" method="GET" style="text-align:center;">
    <input type="text" name="filename" placeholder="Buscar archivo" class="btn secondary" required>
    <button type="submit" class="btn primary animated-button"><span>Buscar</span></button>
</form>

@if (isset($error))
    <p style="color: red; text-align: center;">{{ $error }}</p>
@endif

@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{session('success')}}
</div>
@endif
@if (session('danger'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{session('danger')}}
</div>

<script>
    setTimeout(function() {
        var alert = document.querySelector('.alert');
        if (alert) {
            var alertInstance = bootstrap.Alert.getOrCreateInstance(alert);
            alertInstance.close();
        }
    }, 3000);
</script>
@endif

@if (isset($files) && count($files) > 0)
<table border="1" style="margin: 0 auto;" class="scrollable">
    <thead>
        <tr>
            <th>Nombre del Archivo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($files as $file)
        <tr>
            <td>{{ $file->file_name }}</td>
            <td>
                <form action="{{ route('files.export', $file->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn success animated-button"><span>Descargar</span></button>
                </form>
                
                <form action="{{ route('files.show', $file->id) }}" method="GET" style="display:inline;">
                    <button type="submit" class="btn success animated-button"><span>Ver</span></button>
                </form>

                <form action="{{ route('files.search', $file->id) }}" method="GET" style="display:inline;">
                    <input type="text" name="curp" placeholder="Buscar por CURP" class="btn secondary">
                    <button type="submit" class="btn primary animated-button" required><span>Buscar</span></button>
                </form>

                <form action="{{ route('files.destroy', $file->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar este archivo?');" class="btn danger animated-button"><span>Eliminar</span></button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
    <p style="text-align: center;">No hay archivos disponibles.</p>
@endif

</body>
</html>
@endsection

<style>
    table {
        border-collapse: separate;
        border-spacing: 5px;
        background: rgba(73,97,91,255) bottom left repeat-x;
        color: #fff;
        margin: 20px auto;
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
            
            
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
</style>