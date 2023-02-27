@extends('auth.app')


@push('styles')
<link rel="stylesheet" href="{{ asset('vendor/toastr/toastr.min.css') }}">
@endpush


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
                <a href="{{ route('welcome', ['category' => $category->name]) }}" class="text-decoration-none mx-1">
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

            {{-- Comment --}}
            <h1>Comments</h1><hr>
            {{-- Form Comment --}}
            @if (auth()->check())
                <div class="card my-3 mb-5">
                    <div class="card-body">
                        <form action="{{ route('comments.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <div class="mb-3">
                                <label for="content" class="form-label">Add comment</label>
                                <textarea name="content" id="content" cols="30" rows="2" class="form-control"></textarea>
                            </div>
                            <button type="submit" class="btn btn-dark">Submit</button>
                        </form>
                    </div>
                </div>
            @else
                <div class="alert alert-warning mb-5">
                    Anda harus <a href="{{ route('login') }}" class="text-decoration-none">Login</a> terlebih dahulu untuk dapat mengomentari.
                </div>
            @endif
            {{-- All Comments --}}
            <div class="row mb-5">
                <div class="col-md-12">
                    @forelse($post->comments as $comment)
                        <hr style="margin-top: -16px">
                            {{-- Dropdown Comment --}}
                            @if(auth()->check() && auth()->user()->id == $comment->user_id)
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle-no-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editModal{{ auth()->user()->id }}">Edit Comment</a>
                                            @include('includes.modal-editcomment')
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item">Delete</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            @endif
                            {{-- User --}}
                                <small class="text-muted mx-2">{{ $comment->user->name }}</small> <small class="text-muted"><small> ◉ {{ $post->created_at->diffForHumans() }}</small></small>
                            {{-- Content --}}
                            <p class="card-text">{{ $comment->content }}</p>
                        <hr>
                    @empty
                        <div class="alert alert-secondary">
                            No Comments yet.
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Tag --}}
            @foreach ($post->tag as $tag)
                <a href="{{ route('welcome', ['tag' => $tag->name]) }}" class="text-decoration-none">
                <p class="d-inline me-1">#{{ $tag->name }}</p>
                </a>
            @endforeach 

        </div>
    </div>
</div>


@include('includes.modal-delete')


@push('scripts')
    <script>
        $(document).ready(function() {
            // Ambil tombol edit dan tambahkan event listener
            $('a[data-bs-toggle="modal"]').on('click', function() {
                // Ambil id user dari data-bs-target
                let target = $(this).data('bs-target');
                let id = target.split('#editModal')[1];
            });
        });


        const successMessage = "{{ session()->get('success') }}";
            if (successMessage) {
                toastr.success(successMessage)
            }
    </script>
    <script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('js/delete.js') }}"></script>
    <script src="{{ asset('js/submit.js') }}"></script>
@endpush



@endsection