<form method="POST" action="{{ route('asistencias.entrada', $empleado->id) }}">
    @csrf
    <button type="submit" class="btn btn-success">Registrar Entrada</button>
</form>

<form method="POST" action="{{ route('asistencias.salida', $empleado->id) }}">
    @csrf
    <button type="submit" class="btn btn-danger">Registrar Salida</button>
</form>
