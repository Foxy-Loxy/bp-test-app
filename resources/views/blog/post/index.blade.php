@extends('layouts.app')

@section('content')
    <div class="container">
        @auth
            <a class="btn btn-success" href="{{route('createPost')}}">Create your post</a>
            <hr>
        @endauth
            <a class="btn btn-info" href="{{ route('index', [ 'createdAt' => 'DESC']) }}">Newest -> Oldest</a>
            <a class="btn btn-info" href="{{ route('index', [ 'createdAt' => 'ASC']) }}">Oldest -> Newest</a>
            <br>
            <br>
        @foreach($posts as $post)
            @php /* @var App\Models\Post $post */@endphp
            <div class="card">
                <div class="card-header">
                    <a href="{{route('showPost', ['post' => $post->id,])}}">{{ $post->title }}</a> - posted {{$post->created_at->diffForHumans()}} by <a class="btn-primary" href="{{route('index', [ 'user' => $post->user->id ])}}">{{ $post->user->name }}</a> - @if($post->likers->contains(Auth::user())) &#128154; @else &#128150; @endif {{ $post->likes->count() }} - &#128172; {{ $post->comments->count() }}
                </div>
                <div class="card-body">
                    {{Str::words($post->body, 25, '...')}}
                </div>
                @auth
                    @if($post->user_id === \Auth::user()->id)
                        <a class="btn btn-warning" href="{{route('showUpdatePost', [
                        'post' => $post->id,
                    ])}}">Edit</a>
                        <form class="btn btn-danger" action="{{route('deletePost', [
                        'post' => $post->id,
                    ])}}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    @endif
                @endauth
            </div>
            <br>
        @endforeach
        {{ $posts->links() }}
    </div>
@endsection
