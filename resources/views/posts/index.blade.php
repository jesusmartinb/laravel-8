@extends('layouts.app')

@section('title', 'Blog Posts')

@section('content')
    {{-- @if(count($posts)) --}}
        {{-- Uso de loops o bucles --}}
        {{-- @foreach ($posts as $key => $post) --}}
            {{-- <div>{{ $key }}. {{ $post['title'] }}</div> --}}
        {{-- @endforeach --}}
    {{-- @else --}}
    {{-- No posts found! --}}
    {{-- @endif --}}
    {{-- Cuando tenemos un foreach dentro de un if con una condición de contaje lo podemos simplificar de la siguiente manera usando un forelse --}}

    {{-- La directiva @each toma 4 argumentos, el primero es el nombre del partial template, el segundo la colección a renderizar, tercero el nombre de la variable de iteración en el parcial template, el cuarto es opcional y corresponde al nombre del parcial template a renderizar cuando la collección o array está vacio, es decir el equivalente a la directiva @empty dentro de la directiva @forelse. En la directiva @each sin embargo el parcial template no hereda variables del contexto padre --}}
    {{-- @each('posts.partials.post', $posts, 'post') --}}


     @forelse ($posts as $key => $post)
        {{-- Uso de partials templates. Estos dentro de la directiva @include incorpora las variables que las hereda dentro del contexto en que se encuentra @include. Cuando se utiliza la directiva @include especificamente dentro de un bucle podemos usar la directiva @each en lugar de la directiva de bucle con la directiva @include --}}
        @include('posts.partials.post')
    @empty
        No posts found!
    @endforelse
@endsection
