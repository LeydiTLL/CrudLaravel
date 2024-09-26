@extends('welcome') <!-- Asegúrate de tener un layout principal -->

@section('content')
<div class="container mt-5">
    <h2>Crear Nuevo Empleado</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('empleados.store') }}" method="POST">
        @csrf

        <!-- Nombres -->
        <div class="mb-3">
            <label for="nombres" class="form-label">Nombres <i class="fas fa-user"></i></label>
            <input type="text" class="form-control @error('nombres') is-invalid @enderror" id="nombres" name="nombres" value="{{ old('nombres') }}" required>
            @error('nombres')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Apellidos -->
        <div class="mb-3">
            <label for="apellidos" class="form-label">Apellidos <i class="fas fa-user"></i></label>
            <input type="text" class="form-control @error('apellidos') is-invalid @enderror" id="apellidos" name="apellidos" value="{{ old('apellidos') }}" required>
            @error('apellidos')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Identificación -->
        <div class="mb-3">
            <label for="identificacion" class="form-label">Identificación <i class="fas fa-id-card"></i></label>
            <input type="text" class="form-control @error('identificacion') is-invalid @enderror" id="identificacion" name="identificacion" value="{{ old('identificacion') }}" required>
            @error('identificacion')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Dirección -->
        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección <i class="fas fa-map-marker-alt"></i></label>
            <input type="text" class="form-control @error('direccion') is-invalid @enderror" id="direccion" name="direccion" value="{{ old('direccion') }}" required>
            @error('direccion')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Teléfono -->
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono <i class="fas fa-phone"></i></label>
            <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono" value="{{ old('telefono') }}" required>
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
                    <option value="{{ $pais->id }}">{{ $pais->nombre }}</option>
                @endforeach
            </select>
            @error('pais_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Select de Ciudad (Dinámico) -->
        <div class="mb-3">
            <label for="ciudad_id" class="form-label">Ciudad de nacimiento<i class="fas fa-city"></i></label>
            <select class="form-select @error('ciudad_id') is-invalid @enderror" id="ciudad_id" name="ciudad_id" required>
                <option value="">Seleccione una ciudad</option>
                <!-- Las ciudades relacionadas se cargarán aquí mediante AJAX -->
            </select>
            @error('ciudad_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Multi-Select de Cargos -->
        <div class="mb-3">
            <label for="cargo_id" class="form-label">Cargos <i class="fas fa-briefcase"></i></label>
            <select class="form-select @error('cargo_id') is-invalid @enderror" id="cargo_id" name="cargo_id[]" multiple required>
                @foreach ($cargos as $cargo)
                    <option value="{{ $cargo->id }}">{{ $cargo->nombre }}</option>
                @endforeach
            </select>
            @error('cargo_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Crear Empleado</button>
        <a href="{{ route('empleados.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    // Cuando se selecciona un país, carga las ciudades relacionadas
    $('#pais_id').on('change', function() {
        var paisID = $(this).val();
        if (paisID) {
            $.ajax({
                url: '/getCiudades/' + paisID,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#ciudad_id').empty(); // Limpia el select de ciudades
                    $('#ciudad_id').append('<option value="">Seleccione una ciudad</option>');
                    $.each(data, function(key, value) {
                        $('#ciudad_id').append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        } else {
            $('#ciudad_id').empty();
        }
    });
</script>
@endsection

