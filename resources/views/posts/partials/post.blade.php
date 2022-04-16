        {{-- @break($key == 2) directiva break en un ciclo --}}
        {{-- @continue($key == 1) directiva continue en un ciclo --}}


        @if($loop->even) {{-- En un @each no funciona la variable $loop pues no se hereda del contexto padre --}}
            <div>{{ $key }}. {{ $post['title'] }}</div>
        @else
            <div style="background-color: silver;">{{ $key }}. {{ $post['title'] }}</div>
        @endif

        {{-- caso @each --}}
        {{-- <div>{{ $key }}. {{ $post['title'] }}</div> --}}
