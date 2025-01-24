<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEmpleadoRequest;

class EmpleadoController extends Controller
{
    public function index()
    {
        // Mostrar todos los empleados
        $empleados = Empleado::all();
        return view('empleados.index', compact('empleados'));
    }

    public function create()
    {
        // Mostrar el formulario para crear un empleado
        return view('empleados.create');
    }

    public function store(StoreEmpleadoRequest $request)
    {
        // No es necesario volver a validar porque StoreEmpleadoRequest ya lo hace
        Empleado::create($request->validated()); // Utiliza validated() para obtener los datos validados
        return redirect()->route('empleados.index')->with('success', 'Empleado creado correctamente');
    }

    public function edit(Empleado $empleado)
    {
        // Mostrar el formulario para editar un empleado
        return view('empleados.edit', compact('empleado'));
    }

    public function update(Request $request, Empleado $empleado)
    {
        // Validar y actualizar un empleado
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'dni' => 'required|unique:empleados,dni,' . $empleado->id,
            'cargo' => 'required|string|max:255',
        ]);

        $empleado->update($request->all());
        return redirect()->route('empleados.index')->with('success', 'Empleado actualizado correctamente');
    }

    public function destroy(Empleado $empleado)
    {
        // Eliminar un empleado
        $empleado->delete();
        return redirect()->route('empleados.index')->with('success', 'Empleado eliminado correctamente');
    }
}
