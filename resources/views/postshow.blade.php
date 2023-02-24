@extends('auth.app')


@section('content')

    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                {{-- Title --}}
                <h1 class="mb-3">{{ $post->title }}</h1>

                {{-- Created By --}}
                <p>By. <a href="/posts?user={{ $post->created_by }}" class="text-decoration-none">{{ $post->created_by }}</a></p>

                {{-- Image --}}
                @if ($post->postImages)
                    <img src="{{ asset('storage/postImages/' . $post->postImages) }}" class="-block w-100 mb-3 img-fluid" alt="...">
                @else
                    <img src="https://source.unsplash.com/1120x500" class="-block w-100 mb-3 img-fluid" alt="...">
                @endif

                {{-- Category --}}
                <div class="d-flex justify-content-center">
                    @foreach ($post->category as $category)
                    <a href="" class="text-decoration-none mx-1">
                        <p class="d-inline-block px-2 text-info" style="border: 1px solid; border-radius: 20%;">{{ $category->name }}</p>
                    </a>
                    @endforeach
                </div>

                {{-- Content --}}
                <article class="my-3 fs-5">
                    {!!  $post->content  !!}
                </article>

                {{-- Back to Posts --}}
                <a href="{{ route('welcome') }}" class="btn btn-dark d-inline-block mt-3 mb-5"><i class="bi bi-arrow-bar-left"></i> Back to Posts</a><br>

                {{-- Tag --}}
                @foreach ($post->tag as $tag)
                  <a href="" class="text-decoration-none">
                    <p class="d-inline me-1">#{{ $tag->name }}</p>
                  </a>
                @endforeach 
            </div>
        </div>
    </div>

@endsection