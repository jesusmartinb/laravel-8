@extends('layouts.app')

@section('title', 'Create The Post')


@section('content')
    <form action="{{ route('posts.store') }}" method="post">
        <div><input type="text" name="title" id="title"></div>
        <div><textarea name="content" id="content"></textarea></div>
        <div><input type="submit" value="Create"></div>
    </form>


@endsection
