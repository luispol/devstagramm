@extends('layouts.app')

@section('titulo')
    Editar Perfil: {{auth()->user()->username}} 
@endsection




@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form 
                method="POST"
                action="{{route('perfil.store')}}"
                enctype="multipart/form-data"
                class="mt-10 md:mt-0"
            >
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        UserName
                    </label>
                    <input
                        id="username"
                        name="username" 
                        type="text"
                        placeholder="Tu Nombre de Usuario"
                        class="border p-3 w-full rounded-lg @error('username')
                            border-red-500
                        @enderror"
                        value="{{ auth()->user()->username }}"
                        
                    />
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>


                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Email
                    </label>
                    <input
                        id="email"
                        name="email" 
                        type="text"
                        placeholder="Tu Correo de Usuario"
                        class="border p-3 w-full rounded-lg @error('username')
                            border-red-500
                        @enderror"
                        value="{{ auth()->user()->email }}"
                        
                    />
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>


                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Actual Password
                    </label>
                    <input
                        id="password"
                        name="password" 
                        type="password"
                        placeholder="Tu password de usuario"
                        class="border p-3 w-full rounded-lg @error('password')
                            border-red-500
                        @enderror"
                    />
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="new_password" class="mb-2 block uppercase text-gray-500 font-bold">
                        New Password
                    </label>
                    <input
                        id="new_password"
                        name="new_password" 
                        type="password"
                        placeholder="Tu password de usuario"
                        class="border p-3 w-full rounded-lg @error('password')
                            border-red-500
                        @enderror"
                    />
                    @error('new_password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>



                <div class="mb-5">
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">
                        Imagen Perfil
                    </label>
                    <input
                        id="imagen"
                        name="imagen" 
                        type="file"
                        class="border p-3 w-full rounded-lg @error('username')
                            border-red-500
                        @enderror"
                        value="{{ auth()->user()->username }}"
                        accept=".jpg, .jpeg, .png"
                        
                    />
                </div>

                <input 
                    type="submit"
                    value="Guardar cambios"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"    
                />
            </form>
        </div>
    </div>
@endsection