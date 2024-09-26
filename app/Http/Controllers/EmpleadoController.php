<?php

namespace App\Http\Controllers;

use App\Models\Ciudades;
use App\Models\Empleado;
use App\Models\Cargos;
use App\Models\Paises;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    // Listar todos los empleados
    public function index()
    {
        $empleados = Empleado::all();
        return view('empleados.index', compact('empleados'));
    }

    // Mostrar el formulario para crear un nuevo empleado
    public function create()
    {
        $ciudades = Ciudades::all();
        $cargos = Cargos::all();
        $paises = Paises::all(); // Obtener los países
        return view('empleados.create', compact('ciudades', 'cargos', 'paises'));
    }

    // Guardar un nuevo empleado
    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'identificacion' => 'required|string|max:50|unique:empleados',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:50',
            'ciudad_id' => 'required|exists:ciudades,id',
            'cargo_id' => 'required|array',
            'cargo_id.*' => 'exists:cargos,id',
        ]);
    
        // Crear el empleado
        $empleado = Empleado::create($request->all());
    
        // Guardar la relación en la tabla empleado_cargo
        $empleado->cargos()->attach($request->cargo_id);
    
        return redirect()->route('empleados.index')->with('success', 'Empleado creado exitosamente.');
    }
    

    // Mostrar un empleado específico
    public function show(Empleado $empleado)
    {
        return view('empleados.show', compact('empleado'));
    }

    // Mostrar el formulario para editar un empleado
    public function edit(Empleado $empleado)
    {
        $ciudades = Ciudades::all();
        $cargos = Cargos::all();
        $paises = Paises::all(); // Obtener los países
        return view('empleados.edit', compact('ciudades', 'cargos', 'paises','empleado'));
    }

    public function update(Request $request, Empleado $empleado)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'identificacion' => 'required|string|max:50|unique:empleados,identificacion,'.$empleado->id,
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:50',
            'ciudad_id' => 'required|exists:ciudades,id',
            'cargo_id' => 'required|array',
            'cargo_id.*' => 'exists:cargos,id',
        ]);
    
        // Actualizar los datos del empleado
        $empleado->update($request->all());
    
        // Sincronizar los cargos en la tabla intermedia
        $empleado->cargos()->sync($request->cargo_id);
    
        return redirect()->route('empleados.index')->with('success', 'Empleado actualizado exitosamente.');
    }

    // Borrar (lógicamente) un empleado
    public function destroy(Empleado $empleado)
    {
        $empleado->delete(['is_active' => false]); 
        return redirect()->route('empleados.index')->with('success', 'Empleado eliminado exitosamente.');
    }

    public function getCiudades($pais_id)
    {
        // Obtén las ciudades relacionadas con el país seleccionado
        $ciudades = Ciudades::where('pais_id', $pais_id)->pluck('nombre', 'id');
    
        return response()->json($ciudades);
    }
}
