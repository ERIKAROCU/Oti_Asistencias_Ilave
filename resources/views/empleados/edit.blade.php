<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Empleado') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('empleados.update', $empleado->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                            <input type="text" id="nombre" name="nombre" class="mt-1 block w-full" value="{{ old('nombre', $empleado->nombre) }}" required>
                            @error('nombre')
                                <div class="text-red-600 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="apellido" class="block text-sm font-medium text-gray-700">Apellido</label>
                            <input type="text" id="apellido" name="apellido" class="mt-1 block w-full" value="{{ old('apellido', $empleado->apellido) }}" required>
                            @error('apellido')
                                <div class="text-red-600 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="dni" class="block text-sm font-medium text-gray-700">DNI</label>
                            <input type="text" id="dni" name="dni" class="mt-1 block w-full" value="{{ old('dni', $empleado->dni) }}" required>
                            @error('dni')
                                <div class="text-red-600 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="cargo" class="block text-sm font-medium text-gray-700">Cargo</label>
                            <input type="text" id="cargo" name="cargo" class="mt-1 block w-full" value="{{ old('cargo', $empleado->cargo) }}" required>
                            @error('cargo')
                                <div class="text-red-600 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success">Actualizar</button>
                        <a href="{{ route('empleados.index') }}" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>