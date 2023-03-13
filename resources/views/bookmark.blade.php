@extends('auth.app')


@push('styles')
    <link rel="stylesheet" href="{{ asset('css/post.css') }}">
@endpush


@section('content')
    <div class="container">
        <h1 class="mb-4">Saved Posts</h1>
        <div class="row">
            @forelse ($savedPosts as $post)
                <a href="{{ route('post.show', $post->post->slug) }}" class="text-decoration-none text-dark">
                    <div class="card p-1 mb-3 card-hover">
                        <div class="row">

                            <div class="col-sm-3 m-auto">
                                @if ($post->post->postImages)
                                    <img src="{{ asset('storage/postImages/' . $post->post->postImages) }}" class="w-80 mt-3 mb-2 img-fluid card-img-top" alt="...">
                                @else
                                    <img src="https://source.unsplash.com/400x300" class="w-80 mt-3 mb-2 img-fluid card-img-top" alt="...">
                                @endif
                            </div>
    
                            <div class="col-sm-9 my-auto">

                                {{-- Save --}}
                                <div class="float-end me-2">
                                    @if (Auth::check())
                                        @if ($post->post->savedByUser(Auth::user()))
                                            <form action="{{ route('posts.unsave', $post->post->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-warning" id="like-button">
                                                    <i class="fa fa-bookmark"></i>
                                                </button>
                                            </form>
                                        @endif
                                    @endif
                                </div>

                                {{-- Title --}}
                                <h3 class="fw-bold card-title">{{ Str::limit($post->post->title, 80, '...') }}</h3>

                                {{-- Created By && Created At --}}
                                <p>
                                    <small class="text-muted">By. <span class="text-info">{{ $post->post->created_by }}</span> ◉ {{ $post->post->created_at->diffForHumans() }}</small>
                                </p>

                                {{-- Content --}}
                                <p class="card-title">{{ Str::limit(strip_tags($post->post->content), 250, '...') }}</p>
                            </div>

                        </div>
                    </div>
                </a>
            @empty
                <div class="col-md-12">
                    <p class="text-center fs-3 fw-bold">No saved posts yet.</p>
                </div>
            @endforelse
        </div>
    </div>


    @push('scripts')
        <script src="{{ asset('js/comment.js') }}"></script>
    @endpush

@endsection
