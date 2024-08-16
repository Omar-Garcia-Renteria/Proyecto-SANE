@extends('app')

@section('contenido')
<div class="container w-25 border p-4 mt-4">
<form action="{{ route('citas-update', ['id'=>$cita->id]) }}" method = "POST">
  @method('PATCH')
  @csrf

  @if (session('success'))
    <h6 class="alert alert-success">{{ session('success')}}</h6>
  @endif

  @error('cliente')
  <h6 class="alert alert-danger">{{ $message}}</h6>
  @enderror
    <div class="mb-3">
    <label for="cliente" class="form-label">Cliente</label>
    <input type="text" name ="cliente" class="form-control" value="{{ $cita->cliente }}">
    </div>   
        
  <button type="submit" class="btn btn-primary">Actualizar cliente</button>
</form>

    
</div>

@endsection

