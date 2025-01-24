<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegistrarAsistenciaRequest;
use App\Models\Asistencia;
use App\Models\Empleado;

class AsistenciaController extends Controller
{
    public function index()
    {
        // Obtener todas las asistencias con los datos del empleado
        $asistencias = Asistencia::with('empleado')->get();

        // Retornar la vista de index con las asistencias
        return view('asistencias.index', compact('asistencias'));
    }

    public function registrarFormulario()
    {
        return view('asistencias.registrar');
    }

    public function registrar(RegistrarAsistenciaRequest $request)
    {
        $request->validate([
            'dni' => 'required|numeric',
            'action' => 'required|in:entrada,salida',
        ]);

        // Buscar al empleado por DNI
        $empleado = Empleado::where('dni', $request->dni)->first();

        if (!$empleado) {
            return back()->with('error', 'El empleado con el DNI ingresado no existe.');
        }

        // Registrar entrada o salida según la acción
        if ($request->action === 'entrada') {
            return $this->registrarEntrada($empleado);
        } elseif ($request->action === 'salida') {
            return $this->registrarSalida($empleado);
        }

        return back()->with('error', 'Acción no válida.');
    }

    private function registrarEntrada($empleado)
    {
        // Verificar si ya existe una entrada hoy para el empleado
        $asistenciaHoy = Asistencia::where('empleado_id', $empleado->id)
            ->whereDate('entrada', now()->toDateString())
            ->first();

        if ($asistenciaHoy) {
            return back()->with('error', 'Ya se registró la entrada para hoy.');
        }

        // Crear el registro de entrada
        Asistencia::create([
            'empleado_id' => $empleado->id,
            'entrada' => now(),
        ]);

        return back()->with('success', 'Entrada registrada correctamente.');
    }

    private function registrarSalida($empleado)
    {
        // Verificar si ya existe una entrada hoy para el empleado
        $asistenciaHoy = Asistencia::where('empleado_id', $empleado->id)
            ->whereDate('entrada', now()->toDateString())
            ->first();

        if (!$asistenciaHoy) {
            return back()->with('error', 'No se ha registrado la entrada para hoy.');
        }

        // Verificar si ya existe una salida registrada
        if ($asistenciaHoy->salida) {
            return back()->with('error', 'Ya se ha registrado una salida para hoy.');
        }

        // Registrar la salida
        $asistenciaHoy->salida = now();
        $asistenciaHoy->save();

        return back()->with('success', 'Salida registrada correctamente.');
    }
}
