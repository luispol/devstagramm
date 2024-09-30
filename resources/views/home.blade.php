@extends('layouts.app')

@section('titulo')
Pagina Principal
@endsection

@section('contenido')
    
    <x-listar-post :posts="$posts"/>
        


    {{-- @forelse ($posts as $post )
        <h1>{{$post->titulo}}</h1>
    @empty
        <p>No hay posts</p>
    @endforelse --}}

@endsection