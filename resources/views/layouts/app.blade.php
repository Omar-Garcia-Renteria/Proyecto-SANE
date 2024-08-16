<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mi Aplicación')</title>
    <link href="{{ asset('css/buttons.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
</head>
<body>
    <header class="header1">
        <nav>
            <ul>
            
            <!-- <li><a href="{{ URL::previous() }}">regresar</a></li> -->
             <li><a href="javascript:history.back()"> Volver Atrás</a></li>

            <li><a href="{{ url('/upload') }}">Juntar archivos</a></li>

                <!-- <li><a href="{{ url('/') }}">Inicio</a></li> -->
                <!-- <li><a href="{{ url('/buscar') }}">Buscar</a></li> -->
                <li><a href="{{ url('/csv') }}">Importar</a></li>
                <!-- <li><a href="{{ url('/generar') }}">Generar .csv</a></li> -->
                <li><a href="{{ url('/files') }}">Lista de archivos</a></li>


            </ul>
        </nav>
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        
            <img src="{{ asset('images/sep.png') }}" alt="Secretaria De Educacion Estado De Zacatecas" style="display: block; margin: 0 auto; width: 200px; height: auto;">
            
            <p>© {{ date('Y') }}-{{ date('Y') + 1 }} SEP
            
        </p>
    </footer>
</body>
</html>

