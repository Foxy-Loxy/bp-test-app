@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="{{route('updatePost', [
            'post' => $post->id,
        ])}}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <label for="title">Title</label>
            <br>
            <input name="title" id="title" style="width: 100%;" required value="{{ $post->title }}">
            <br>
            <label for="body">Body</label>
            <br>
            <textarea style="width: 100%" name="body" id="body" cols="30" rows="10" required>{{ $post->body }}</textarea>
            <hr>
            <button class="btn btn-info" type="submit">Update</button>
        </form>
    </div>
@endsection
