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
    <div class="p-6 bg-white border-b border-gray-200 justify-center grid grid-cols-3">
        <div class="w-full max-w-xs justify-center"></div>
        <div class="w-full max-w-xs justify-center">
            @if ($loginOK)
                <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="/changepin" method="post">
                    @csrf
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="userpin">
                        Introduzca su PIN actual:
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="userpin" type="text" placeholder="****" name="userpin">

                    <label class="block text-gray-700 text-sm font-bold mb-2" for="newpin">
                        Introduzca su nuevo PIN:
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="newpin" type="text" placeholder="****" name="newpin">

                    <label class="block text-gray-700 text-sm font-bold mb-2" for="newpin2">
                        Introduzca de nuevo su nuevo PIN:
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="newpin2" type="text" placeholder="****" name="newpin2">
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
            @endif
        </div>
        <div class="w-full max-w-xs justify-center"></div>
    </div>
</x-app-layout>
