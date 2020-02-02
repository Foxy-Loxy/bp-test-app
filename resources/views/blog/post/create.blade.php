@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="{{route('savePost')}}">
            {{ csrf_field() }}
            {{ method_field('POST') }}

            <label for="title">Title</label>
            <br>
            <input name="title" id="title" style="width: 100%;" required>
            <br>
            <label for="body">Body</label>
            <br>
            <textarea style="width: 100%" name="body" id="body" cols="30" rows="10" required></textarea>
            <hr>
            <button class="btn btn-primary" type="submit">Publish</button>
        </form>
    </div>
@endsection
