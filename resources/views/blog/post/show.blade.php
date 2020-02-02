@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>{{$post->title}}</h4>
        @auth
            <br>
            @if($post->user_id === \Auth::user()->id)
                <form style="display: inline-block;" action="{{route('deletePost', [
                    'post' => $post->id,
                ])}}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form>
                <a class="btn btn-warning" href="{{route('showUpdatePost', [
                            'post' => $post->id,
                        ])}}">Edit</a>
            @endif
        @endauth
        <br>
        Posted on {{$post->created_at->format('l jS \\of F Y \\a\\t h:i:s A')}} by <a href="{{ route('index', [ 'user' => $post->user->id ]) }}" class="btn-primary">{{ $post->user->name }}</a>
        <br>
        <span id="likeBtn">@if($post->likers->contains(Auth::user())) &#128154; @else &#128150; @endif</span> <span id="likeCount">{{ $post->likes->count() }}</span>
        <hr>
        {{$post->body}}
        <hr>
    </div>
    <div class="container">
        <h4>Commments ({{$post->comments->count()}})</h4>
        <hr>
        @php /* @var \App\Models\Comment $comment */@endphp
        @forelse($post->comments as $comment)
            <div class="card">
                <div class="card-header">
                    <span class="btn-primary">{{$comment->user->name}}</span> commented {{$comment->created_at->diffForHumans()}}
                </div>
                <div class="card-body">
                    {{ $comment->body }}
                </div>
            </div>
            <br>
        @empty
            <h5>There are no comments right now</h5>
        @endforelse
        @auth
            <hr>
            <h4>Write your comment</h4>
            <form action="{{route('createComment')}}" method="POST">
                {{ csrf_field() }}
                {{ method_field('POST') }}

                <input type="hidden" name="post_id" value="{{$post->id}}">

                <textarea style="width: 100%;" name="body" id="" cols="30" rows="10"></textarea>
                <br>
                <button class="btn btn-primary" type="submit">Comment</button>
            </form>
        @endauth
    </div>
@endsection

@section('script')
    @auth
        <script>
            document.addEventListener("DOMContentLoaded", function(event) {
                document.getElementById('likeBtn').addEventListener('click', () => {
                    fetch('{{route('likePost', [
                        'post' => $post->id,
                    ])}}', {
                        credentials: 'include',
                        method: 'PUT',
                    })
                        .then((response) => {
                            return response.json();
                        })
                        .then((rJson) => {
                            document.getElementById('likeBtn').innerHTML = rJson.hasUserLike ? "&#128154;" : "&#128150";
                            document.getElementById('likeCount').innerHTML = rJson.count;
                        });
                });
            });
        </script>
    @endauth
@endsection
