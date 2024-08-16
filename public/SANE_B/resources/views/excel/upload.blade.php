<!DOCTYPE html>
<html>
<head>
    <title>Subir Archivo Excel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            color: #343a40;
            margin: 0; 
            padding: 0;
        }

        .header {
            background-color: #007bff;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }

        h1 {
            text-align: center;
            color: #343a40;
            margin-top: 20px;
        }

        form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input[type="file"] {
            display: block;
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Subir Archivo Excel</h1>
    </div>
    
    @extends('layouts.app')

    @section('content')
        <form action="{{ route('excel.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="excel_file" required>
            <button type="submit">Subir</button>
        </form>
    @endsection
</body>
</html>
