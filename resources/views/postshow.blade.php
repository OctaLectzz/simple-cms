@extends('auth.app')


@section('content')

    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <h1 class="mb-3">{{ $post->title }}</h1>

                <p>By. <a href="/posts?user={{ $post->created_by }}" class="text-decoration-none">{{ $post->created_by }}</a></p>

                @if ($post->postImages)
                    <img src="{{ asset('storage/postImages/' . $post->postImages) }}" class="d-block w-100" alt="..." height="500">
                @else
                    <img src="https://source.unsplash.com/1120x500" class="card-img-top" alt="">
                @endif

                <p class="badge badge-info">{{ $post->category }}</p>

                <article class="my-3 fs-5">
                    {!!  $post->content  !!}
                </article>

                <a href="{{ route('welcome') }}" class="d-block mt-3">Back to Posts</a>
            </div>
        </div>
    </div>

@endsection