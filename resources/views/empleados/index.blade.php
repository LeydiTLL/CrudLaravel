@extends('welcome')

@section('content')
    <h1 class="mb-4">Listado de Empleados</h1>
    <a href="{{ route('empleados.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Crear Nuevo Empleado
    </a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-hover table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Identificación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($empleados as $empleado)
                <tr>
                    <td>{{ $empleado->nombres }}</td>
                    <td>{{ $empleado->apellidos }}</td>
                    <td>{{ $empleado->identificacion }}</td>
                    <td>
                        <a href="{{ route('empleados.show', $empleado) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i> Ver
                        </a>
                        <a href="{{ route('empleados.edit', $empleado) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <form action="{{ route('empleados.destroy', $empleado) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection