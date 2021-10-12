<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ Auth::user()->name }}: {{ Auth::user()->descripcion }}
        </h2>
    </x-slot>
    <div class="p-6 bg-white border-b border-gray-200 justify-center">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">Nuevo empleado</h1>
        <div class="mx-80">
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="/nuevo_empleado" method="post" enctype="multipart/form-data">
                @csrf
                <label class="block text-gray-700 text-sm font-bold mb-2" for="nombre">
                    Nombre:
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="nombre" type="text" placeholder="Nombre" name="nombre">

                <label class="block text-gray-700 text-sm font-bold mb-2" for="apellidos">
                    Apellidos:
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="apellidos" type="text" placeholder="Apellidos" name="apellidos">

                <label class="block text-gray-700 text-sm font-bold mb-2" for="identificacion">
                    DNI/NIE:
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="identificacion" type="text" placeholder="12345678-X" name="identificacion">

                <label class="block text-gray-700 text-sm font-bold mb-2" for="horasDia">
                    Jornada laboral (horas al dia):
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="horasDia" type="text" placeholder="8" name="horasDia">

                <label for="imagen" class="form-label">
                    Cargar Imagen
                </label>
                <input name="imagen" class="form-control" type="file" id="imagen">
                <input type="submit" value="Insertar" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full max-h-10 mt-4"/>
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
</x-app-layout>
