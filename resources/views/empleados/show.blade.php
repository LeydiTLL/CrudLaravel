@extends('welcome') <!-- Asegúrate de tener un layout principal -->

@section('content')
<div class="container mt-5">
    <h2>Detalles del Empleado</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $empleado->nombres }} {{ $empleado->apellidos }}</h5>
            <p class="card-text"><strong>Identificación:</strong> {{ $empleado->identificacion }}</p>
            <p class="card-text"><strong>Dirección:</strong> {{ $empleado->direccion }}</p>
            <p class="card-text"><strong>Teléfono:</strong> {{ $empleado->telefono }}</p>
            <p class="card-text"><strong>Ciudad de nacimiento:</strong> {{ $empleado->ciudad->nombre }}</p> <!-- Asumiendo que tienes una relación con Ciudad -->
            <p class="card-text"><strong>Estado:</strong> {{ $empleado->is_active ? 'Activo' : 'Eliminado' }}</p>

            <!-- Mostrar cargos -->
            <p class="card-text"><strong>Cargos:</strong> 
                @if ($empleado->cargos->isNotEmpty())
                    <ul>
                        @foreach ($empleado->cargos as $cargo)
                            <li>{{ $cargo->nombre }}</li>
                        @endforeach
                    </ul>
                @else
                    <span>No tiene cargos asignados.</span>
                @endif
            </p>
        </div>
    </div>
</div>
@endsection
    
