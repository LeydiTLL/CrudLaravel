@extends('welcome') <!-- Asegúrate de tener un layout principal -->

@section('content')
<div class="container mt-5">
    <h2>Editar Empleado</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('empleados.update', $empleado->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Método para actualizar -->

        <div class="mb-3">
            <label for="nombres" class="form-label">Nombres <i class="fas fa-user"></i></label>
            <input type="text" class="form-control @error('nombres') is-invalid @enderror" id="nombres" name="nombres" value="{{ old('nombres', $empleado->nombres) }}" required>
            @error('nombres')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="apellidos" class="form-label">Apellidos <i class="fas fa-user"></i></label>
            <input type="text" class="form-control @error('apellidos') is-invalid @enderror" id="apellidos" name="apellidos" value="{{ old('apellidos', $empleado->apellidos) }}" required>
            @error('apellidos')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="identificacion" class="form-label">Identificación <i class="fas fa-id-card"></i></label>
            <input type="text" class="form-control @error('identificacion') is-invalid @enderror" id="identificacion" name="identificacion" value="{{ old('identificacion', $empleado->identificacion) }}" required>
            @error('identificacion')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección <i class="fas fa-map-marker-alt"></i></label>
            <input type="text" class="form-control @error('direccion') is-invalid @enderror" id="direccion" name="direccion" value="{{ old('direccion', $empleado->direccion) }}" required>
            @error('direccion')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono <i class="fas fa-phone"></i></label>
            <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono" value="{{ old('telefono', $empleado->telefono) }}" required>
            @error('telefono')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Select de País -->
        <div class="mb-3">
            <label for="pais_id" class="form-label">País <i class="fas fa-globe"></i></label>
            <select class="form-select @error('pais_id') is-invalid @enderror" id="pais_id" name="pais_id" required>
                <option value="">Seleccione un país</option>
                @foreach ($paises as $pais)
                    <option value="{{ $pais->id }}" {{ $pais->id == $empleado->ciudad->pais_id ? 'selected' : '' }}>
                        {{ $pais->nombre }}
                    </option>
                @endforeach
            </select>
            @error('pais_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Select de Ciudad (vacío inicialmente) -->
        <div class="mb-3">
            <label for="ciudad_id" class="form-label">Ciudad <i class="fas fa-city"></i></label>
            <select class="form-select @error('ciudad_id') is-invalid @enderror" id="ciudad_id" name="ciudad_id" required>
                <option value="">Seleccione una ciudad</option>
                @foreach ($ciudades as $ciudad)
                    <option value="{{ $ciudad->id }}" {{ $ciudad->id == $empleado->ciudad_id ? 'selected' : '' }}>
                        {{ $ciudad->nombre }}
                    </option>
                @endforeach
            </select>
            @error('ciudad_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Multi-Select para los cargos -->
        <div class="mb-3">
            <label for="cargo_id" class="form-label">Cargos <i class="fas fa-briefcase"></i></label>
            <select class="form-select @error('cargo_id') is-invalid @enderror" id="cargo_id" name="cargo_id[]" multiple required>
                @foreach ($cargos as $cargo)
                    <option value="{{ $cargo->id }}" {{ in_array($cargo->id, $empleado->cargos->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $cargo->nombre }}
                    </option>
                @endforeach
            </select>
            @error('cargo_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Empleado</button>
        <a href="{{ route('empleados.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection

<!-- Script para cargar ciudades dinámicamente -->
@section('scripts')
<script>
    document.getElementById('pais_id').addEventListener('change', function () {
        var paisId = this.value;
        var ciudadSelect = document.getElementById('ciudad_id');

        ciudadSelect.innerHTML = '<option value="">Cargando ciudades...</option>';

        // Realiza la solicitud AJAX para obtener las ciudades
        fetch(`/api/ciudades/${paisId}`)
            .then(response => response.json())
            .then(data => {
                ciudadSelect.innerHTML = '<option value="">Seleccione una ciudad</option>';
                data.forEach(function (ciudad) {
                    ciudadSelect.innerHTML += `<option value="${ciudad.id}">${ciudad.nombre}</option>`;
                });
            })
            .catch(error => {
                ciudadSelect.innerHTML = '<option value="">Error al cargar ciudades</option>';
                console.error('Error al cargar ciudades:', error);
            });
    });
</script>
@endsection


