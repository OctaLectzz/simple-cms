@extends('auth.app')


@section('content')

<div class="container">

  {{-- Title --}}
  <h1 class="mb-3 text-center">Posts</h1>
  {{-- Title --}}

  {{-- Search --}}
  {{-- <div class="row justify-content-center mb-3">
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
  </div> --}}
  {{-- Search --}}

  {{-- Pinned Post --}}
  <div id="carouselExampleCaptions" class="carousel slide mb-3" data-bs-ride="carousel">

    <div class="carousel-indicators">
      @foreach($pinnedPost as $index => $post)
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"></button>
      @endforeach
    </div>

    <div class="carousel-inner">
      @foreach ($pinnedPost as $post)
        <a href="{{ route('post.show', $post->slug) }}">
          <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
            
            {{-- Image --}}
            @if ($post->postImages)
              <img src="{{ asset('storage/postImages/' . $post->postImages) }}" class="d-block w-100" alt="..." height="500" style="filter: brightness(60%)">
            @else
              <img src="https://source.unsplash.com/1120x500" class="d-block w-100" alt="..." height="500" style="filter: brightness(60%)">
            @endif

            <div class="carousel-caption d-none d-md-block">
              {{-- Title --}}
              <h4 class="fw-bold">{{ $post->title }}</h4>

              {{-- Content --}}
              <p>{{ Str::limit(strip_tags($post->content), 70, '...') }}</p>

              {{-- Category --}}
              @foreach($post->category as $category)
                <p class="d-inline-block mx-1 px-2" style="border: 1px solid; border-radius: 50px;">{{ $category->name }}</p>
              @endforeach
            </div>
  
          </div>
        </a>
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
        <div class="col-md-4 mb-3">
          <div class="card">

            {{-- Image --}}
            <a href="{{ route('post.show', $post->slug) }}">
              @if ($post->postImages)
                <img src="{{ asset('storage/postImages/' . $post->postImages) }}" class="card-img-top" alt="">
              @else
                <img src="https://source.unsplash.com/500x300" class="card-img-top" alt="">
              @endif
            </a>

            <div class="card-body">
              {{-- Category --}}
              @foreach ($post->category->take(3) as $category)
                <a href="" class="text-decoration-none">
                  <p class="d-inline-block px-2 text-info" style="border: 1px solid; border-radius: 20%;">{{ $category->name }}</p>
                </a>
              @endforeach

              {{-- Title --}}
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
      @endforeach
    </div>
  </div>
  {{-- More Posts --}}

  {{-- Pagination --}}
  @if ($post->is_pinned === 0) 
    <div class="d-flex justify-content-center">
      {{ $posts->links() }}
    </div>
  @endif
  {{-- Pagination --}}

</div>

@endsection