@extends('layouts.app')

@section('title', $post['title'])

@section('content')
    {{-- Renderizado condicional Uso de la directiva @if @elseif o @else --}}
    @if($post['is_new'])
    <div>
        A new blog post! Using if
    </div>
    {{-- @elseif(!$post['is_new']) --}}
    @else
    <div>
        Blog post is old! using elseif
    </div>
    @endif

    {{-- Alternativa al renderizado condicional con @unless. La condición ha de ser falsa y no hay alternativa con @else o @elseif --}}
    @unless($post['is_new'])
    <div>
        It is al old post... using unless
    </div>
    @endunless

    {{-- isset() - es variable o llave de array difinido --}}
    {{-- empty() - es false, 0, array vacio --}}

    <h1>{{ $post['title'] }}</h1>
    <p>{{ $post['content'] }}</p>

    @isset($post['has_comments'])
        <div>
            The post has some comments... using isset
        </div>
    @endisset

    {{-- Otros ejemplos de directivas
    @auth... @endauth
    @guest... @endguest
    @auth('admin')... @endauth
    @hasSection('content')...  @endif
    @sectionMissing('content')... @endif
    @production...  @endproduction
    @switch()
        @case()

            @break

        @default

    @endswitch --}}

@endsection
