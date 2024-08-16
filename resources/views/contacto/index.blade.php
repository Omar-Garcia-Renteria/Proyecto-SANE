@extends('app')

@section('contenido')
<div class="container w-25 border p-4 mt-4">
<form action="{{ route('agenda') }}" method = "POST">
  @csrf

  @if (session('success'))
    <h6 class="alert alert-success">{{ session('success')}}</h6>
  @endif

  @error('cliente')
  <h6 class="alert alert-danger">{{ $message}}</h6>
  @enderror
    <div class="mb-3">
    <label for="cliente" class="form-label">Cliente</label>
    <input type="text" name ="cliente" class="form-control">
    </div>
        
  <button type="submit" class="btn btn-primary">Nuevo cliente</button>
</form>

<div>
  @foreach ($citas as $cita)
  <div class="row py-1">
    <div class="col-md-5 d-flex justify-content-end">
      <a href="{{ route('citas-show', ['id' => $cita->id]) }}">{{$cita->cliente}}</a>
    </div>
    <div class="col-md-5 d-flex justify-content-end">
      <form action="{{ route('citas-destroy', [$cita->id]) }}" method="POST">
          @method('DELETE')
          @csrf
          <button class="btn btn-danger btm-sm">Eliminar</button>
      </form>  
    </div>
  </div>  
  @endforeach
</div>

    
</div>

@endsection

