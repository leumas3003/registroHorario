<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ Auth::user()->name }}: {{ Auth::user()->descripcion }}
        </h2>
    </x-slot>

    <div class="p-6 bg-white border-b border-gray-200 grid grid-cols-3">
        @foreach($empleados as $empleado)
            <div class="m-1 mx-1 rounded-lg shadow-lg bg-gray-600 flex flex-row flex-wrap p-3 antialiased">
                <div class="md:w-1/3 w-full">
                    @if ($empleado->imagen == null)
                        <img class="rounded-lg shadow-lg antialiased"
                            src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png">
                    @else
                        <img class="rounded-lg shadow-lg antialiased"
                            src="{{$empleado->imagen}}">
                    @endif
                </div>
                <div class="md:w-1/3 w-full px-3 flex flex-row flex-wrap">
                    <div class="w-full text-right text-gray-700 font-semibold relative pt-3 md:pt-0">
                        <div class="text-base text-white leading-tight">{{ $empleado->apellidos }},
                            {{ $empleado->nombre }} </div>
                    </div>
                </div>
                <div class="place-items-end">
                    <a href="/empleado/{{ $empleado->id }}">
                        <button
                            class="modal-open bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full max-h-10">
                            Acceder
                        </button></a>
                </div>
            </div>
        @endforeach
    </div>


</x-app-layout>
