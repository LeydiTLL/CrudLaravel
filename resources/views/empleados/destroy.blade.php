@extends('welcome') <!-- Asegúrate de tener un layout principal -->

@section('content')
<div class="container mt-5">
    <h2>Eliminar Empleado</h2>

    <div class="alert alert-danger">
        ¿Estás seguro de que deseas eliminar a <strong>{{ $empleado->nombres }} {{ $empleado->apellidos }}</strong>? Esta acción no se puede deshacer.
    </div>

    <form action="{{ route('empleados.destroy', $empleado->id) }}" method="POST">
        @csrf
        @method('DELETE') <!-- Método para eliminar -->
        
        <button type="submit" class="btn btn-danger">Confirmar Eliminación</button>
        <a href="{{ route('empleados.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
