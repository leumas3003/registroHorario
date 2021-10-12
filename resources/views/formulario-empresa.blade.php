<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ Auth::user()->name }}: {{ Auth::user()->descripcion }}
        </h2>
    </x-slot>
    <div class="p-6 bg-white border-b border-gray-200 justify-center">
        @if (Auth::user()->admin)
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">Nueva empresa</h1>
            <div class="mx-80">
                <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="/nueva_empresa" method="post" enctype="multipart/form-data">
                    @csrf
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                        Nombre:
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="name" type="text" placeholder="Nombre" name="name">

                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Email:
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="email" type="text" placeholder="a@a.com" name="email">

                    <label class="block text-gray-700 text-sm font-bold mb-2" for="descripcion">
                        Descripcion:
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="descripcion" type="text" placeholder="Descripcion de la empresa" name="descripcion">

                    <label class="block text-gray-700 text-sm font-bold mb-2" for="anyo">
                        Año creacion:
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="anyo" type="text" placeholder="2013" name="anyo">

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
        @endif
    </div>
</x-app-layout>
