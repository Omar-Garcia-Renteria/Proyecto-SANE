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
    <header>
    <nav class="header2">
        Importar archivo (CSV)
    </nav>
    </header>

    <h1 style="text-align:center;">Importar Archivo</h1>
    <table border="1" style="margin: 0 auto;">
<tr>
    <td>
    <form action="{{ route('importar2.post') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="document_csv">
    <button type="submit" onclick="return confirm('¿Quieres importar este archivo?');" class="btn success animated-button" redirect="list_files" required><span>Importar</span></button>
</form></td></tr>


</table>

</body>
</html>
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
</style>

<script>
//     $(document).ready(function() {
//   $('a[href^="#"]').click(function() {
//     var destino = $(this.hash); //this.hash lee el atributo href de este
//     $('html, body').animate({ scrollTop: destino.offset().top }, 700); //Llega a su destino con el tiempo deseado
//     return false;
//   });
// });
// <a href="#footer">ir abajo</a>

//     window.onscroll = function(){
//     if(document.documentElement.scrollTop > 100){
//         document.querySelector('go-top-container')
//         .classList.add('show');
//     }
//     else{
//         document.querySelector('go-top-container')
//         .classList.remove('show');
//         }
//     }
// document.querySelector('go-top-container')
// .addEventListener('click', ()=>{
//     window.scrollTop({
//         top: 0,
//         behavior: 'smooth'
//     });
// });
</script>
