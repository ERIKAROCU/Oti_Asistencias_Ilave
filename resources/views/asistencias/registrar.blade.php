<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registrar Asistencia') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Mensajes de éxito o error -->
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Formulario para registrar asistencia -->
                    <form action="{{ route('asistencias.registrar') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="dni" class="block text-gray-700 text-sm font-bold mb-2">Ingrese el DNI del empleado:</label>
                            <input type="text" name="dni" id="dni" class="form-control w-full p-2 border rounded" placeholder="DNI del empleado" required>
                        </div>

                        <div class="flex space-x-4">
                            <button type="submit" name="action" value="entrada" class="btn btn-primary">Registrar Entrada</button>
                            <button type="submit" name="action" value="salida" class="btn btn-danger">Registrar Salida</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
