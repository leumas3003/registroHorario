<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ Auth::user()->name }}: {{ Auth::user()->descripcion }}
        </h2>
    </x-slot>
    @if (!$loginOK)
        <div class="p-6 bg-white border-b border-gray-200 grid grid-cols-1">
            <div class="p-6 bg-white border-b border-gray-200 grid grid-cols-1 justify-center mx-40">
                <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="/listado" method="post">
                    @csrf
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Introduzca su password de empresa:
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="password" type="text" placeholder="******" name="password">
                    <input type="submit" value="Acceder" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full max-h-10 mt-4"/>
                </form>
                @if ($errors->any())
                <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            </div>
        </div>
    @else
        <div class="p-6 bg-white border-b border-gray-200 grid grid-cols-2">
            <div class="p-6 bg-white border-b border-gray-200 grid grid-cols-1 justify-center mx-40">
                <a href="/nuevo_empleado">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full max-h-10 mt-4">
                        Inserta nuevo empleado
                    </button></a>
            </div>
            @if (Auth::user()->admin)
                <div class="p-6 bg-white border-b border-gray-200 grid grid-cols-1 justify-center mx-40">
                    <a href="/nueva_empresa">
                        <button
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full max-h-10 mt-4">
                            Inserta nueva empresa
                        </button></a>
                </div>
            @endif
        </div>
        <div class="p-6 bg-white border-b border-gray-200 grid grid-cols-1">
            <div class="p-6 bg-white border-b border-gray-200 grid grid-cols-1 justify-center mx-40">
                <table class="table-auto">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Apellidos</th>
                            <th class="px-4 py-2">Nombre</th>
                            <th class="px-4 py-2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($empleados as $empleado)
                            <tr>
                                <td class="border px-4 py-2">{{ $empleado->apellidos }}</td>
                                <td class="border px-4 py-2">{{ $empleado->nombre }}</td>
                                <td class="border px-4 py-2">
                                    <form action="/borrar_empleado" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $empleado->id }}">
                                        <button type="submit" class="btn btn-danger" value="">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif


</x-app-layout>
