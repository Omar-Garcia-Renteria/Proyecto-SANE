@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="{{asset('css/app.css')}}" type="text/css"> -->
    <title>Importar</title>
</head>
<body>
 
    
</body>
<body>
    <header>
    <nav>
        
    </nav>
    </header>
    <form action="{{ route('importar.post') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="document_csv" required>
    <button type="submit" class="btn danger">Generar archivo</button>
</form>

<a href="/files">Ver Archivos</a>
    
</body>
</html>
@endsection

<style>
    .btn {
  border: none; 
  color: black; 
  padding: 14px 28px; 
  cursor: pointer; 
  border-radius: 5px; 
}
.primary {background-color: white; border: 2px solid #007bff;} 
.primary:hover {background: #0b7dda; color: white;}
.secondary {background-color: white; border: 2px solid #e7e7e7;} 
.secondary:hover {background: #ddd; color: white;}
.success {background-color: white; border: 2px solid #04AA6D;} 
.success:hover {background-color: #46a049; color: white;}
.warning {background-color: white; border: 2px solid #ff9800;} 
.warning:hover {background: #e68a00; color: white;}
.danger {background-color: white; border: 2px solid #f44336;} 
.danger:hover {background: #da190b; color: white;}
</style>