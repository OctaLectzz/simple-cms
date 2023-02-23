@extends('auth.app')


@section('content')

<div class="container">

  {{-- Title --}}
  <h1 class="mb-3 text-center">{{ $title }}</h1>
  {{-- Title --}}

  {{-- Search --}}
  <div class="row justify-content-center mb-3">
    <div class="col-md-6">
        <form action="/">
          @if (request('category'))
          <input type="hidden" name="category" value="{{ request('category') }}">
          @endif
          @if (request('author'))
          <input type="hidden" name="author" value="{{ request('author') }}">
          @endif
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Search..." name="search" value="{{ request('search') }}">
            <button class="btn btn-dark" type="submit">Search</button>
          </div>
        </form>
    </div>
  </div>
  {{-- Search --}}

  {{-- Pinned Post --}}
  <div id="carouselExampleCaptions" class="carousel slide mb-3" data-bs-ride="carousel">

    <div class="carousel-indicators">
      @foreach($posts as $index => $post)
        @if ($post->is_pinned === 1) 
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}" aria-label="Slide {{ $index + 1 }}"></button>
        @endif
      @endforeach
    </div>

    <div class="carousel-inner">
      @foreach ($posts as $index => $post)
        @if ($post->is_pinned === 1) 
          <a href="{{ route('post.show', $post->slug) }}">
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                <img src="{{ asset('storage/postImages/' . $post->postImages) }}" class="d-block w-100" alt="..." height="500" style="filter: brightness(60%)">
              <div class="carousel-caption d-none d-md-block">
                <h5>{{ $post->title }}</h5>
                <p>{{ Str::limit(strip_tags($post->content), 70, '...') }}</p>
                @foreach($post->category as $category)
                    <p class="btn btn-sm btn-outline-warning text-light">{{ $category->name }}</p>
                @endforeach
              </div>
            </div>
          </a>
        @endif
      @endforeach
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
    
  </div>
  {{-- Pinned Post --}}

  {{-- More Posts --}}
  <div class="container">
    <div class="row">
      @foreach ($posts as $post)
        @if ($post->is_pinned === 0) 
          <div class="col-md-4 mb-3">
            <div class="card">
              @if ($post->postImages)
                <img src="{{ asset('storage/postImages/' . $post->postImages) }}" class="card-img-top" alt="">
              @endif
              <div class="card-body">
                @foreach ($post->category as $category)
                  <a href="">
                    <p class="btn btn-sm btn-outline-primary">{{ $category->name }}</p>
                  </a>
                @endforeach
                <h5 class="card-title">{{ Str::limit($post->title, 35, '..') }}</h5>
                <p>
                  <small class="text-muted">
                    By. <a href="" class="text-decoration-none me-2">{{ $post->created_by }}</a> ◉ {{ $post->created_at->diffForHumans() }}
                  </small>
                </p>
                <p class="card-text">{{ Str::limit(strip_tags($post->content), 80, '...') }}</p>
                <a href="{{ route('post.show', $post->slug) }}" class="btn btn-outline-dark">Read More</a>
              </div>
            </div>
          </div>
        @endif
      @endforeach
    </div>
  </div>
  {{-- More Posts --}}

</div>

@endsection