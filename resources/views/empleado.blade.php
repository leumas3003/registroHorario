<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $empleado->apellidos }}, {{ $empleado->nombre }}<br>
        @if ($loginOK)
                {{ $empleado->identificacion }}
            </h2>
                <h1>Jornada de {{ $empleado->horasDia }} horas</h1>
        @else
            </h2>
        @endif
    </x-slot>
    <div class="p-6 bg-white border-b border-gray-200 grid grid-cols-3 justify-center">
        <div class="ml-20 md:w-1/3 w-full">
            @if ($empleado->imagen == null)
                <img class="rounded-lg shadow-lg antialiased"
                    src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png">
            @else
                <img class="rounded-lg shadow-lg antialiased"
                    src="{{$empleado->imagen}}">
            @endif
        </div>
        <div class="w-full max-w-xs">
            @if (!$loginOK)
                <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="/empleado" method="post">
                    @csrf
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="userpin">
                        Introduzca su PIN:
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="userpin" type="text" placeholder="****" name="userpin">
                    <input type="hidden" id="empleadoId" value="{{$empleado->id}}" name="empleadoId"/>
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
            @else
                @if($registroHoy->count() == 0)
                    <form action="/registroEntrada" method="post">
                        @csrf
                        <input type="hidden" id="empleadoId" value="{{$empleado->id}}" name="empleadoId"/>
                        <input type="submit" value="Registro de Entrada" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full max-h-10 mt-4"/>
                    </form>
                @elseif ($registroHoy[0]->horaSalida == null)
                    <form action="/registroSalida" method="post">
                        @csrf
                        <input type="hidden" id="empleadoId" value="{{$empleado->id}}" name="empleadoId"/>
                        <input type="submit" value="Registro de Salida" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full max-h-10 mt-4"/>
                    </form>
                @endif

            @endif
        </div>
        <div class="w-full max-w-xs">
            @if ($loginOK)
                <a href="/changepin/{{ $empleado->id }}">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full max-h-10 mt-4">
                        Cambiar el PIN
                    </button></a>
            @endif
        </div>
    </div>
    @if ($loginOK)
        <div class="p-6 bg-white border-b border-gray-200 grid grid-cols-1 justify-center m-8">
            <table class="table-auto">
                <thead>
                    <tr>
                        <th class="px-4 py-2">Dia</th>
                        <th class="px-4 py-2">Hora Entrada</th>
                        <th class="px-4 py-2">Hora Salida</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($registros as $registro)
                        <tr>
                            <td class="border px-4 py-2">{{ $registro->dia }}</td>
                            <td class="border px-4 py-2">{{ $registro->horaEntrada }}</td>
                            <td class="border px-4 py-2">{{ $registro->horaSalida }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</x-app-layout>
