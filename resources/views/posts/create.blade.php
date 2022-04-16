@extends('layouts.app')

@section('title', 'Create The Post')


@section('content')
    <form action="{{ route('posts.store') }}" method="post">
        @csrf
        <div><input type="text" name="title" id="title"></div>
        {{-- Para mostrar los errores asociados a un campo se utiliza la directiva @error(). El código de la directiva @error solo se mostrará si se produce un error en el input asociado. Entonces se puede imprimir el error usando la variable especial message. --}}
        @error('title')
            <div>{{ $message }}</div>
        @enderror
        <div><textarea name="content" id="content"></textarea></div>
        {{-- Para mostrar todos los errores desde el formulario, primero hemos de chekear si hay algún error usando la directiva @if y el objeto errors con el método any() obtendremos toda los errores en el interior de la variable errors --}}
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div><input type="submit" value="Create"></div>
    </form>


@endsection
