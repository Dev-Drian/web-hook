<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-blue-500 text-white p-4 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold">Número de Usuarios</h3>
                        <p class="text-2xl">{{ $numUsuarios }}</p>
                    </div>
                    <div class="bg-green-500 text-white p-4 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold">Usuarios Premium</h3>
                        <p class="text-2xl">{{ $numUsuariosPremium }}</p>
                    </div>
                    <div class="bg-red-500 text-white p-4 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold">Solicitudes</h3>
                        <p class="text-2xl">{{ $numRequests }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>