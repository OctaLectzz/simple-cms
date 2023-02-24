@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col">


                <div class="card">
                    <div class="card-header">{{ __('Edit Post') }}</div>
                    <div class="card-body">

                        <form action="" method="POST" enctype="multipart/form-data">
                            @method('put')
                            @csrf

                            {{-- Pinned  --}} 
                            <div class="row mb-3"> 
                                <label for="is_pinned" 
                                    class="col-md-4 col-form-label text-md-end">{{ __('Pin') }}</label> 

                                <div class="col-md-6"> 
                                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group"> 
                                        <input type="radio" class="btn-check" name="is_pinned" id="is_pinned1" value="1" {{ $post->is_pinned == 1 ? 'checked' : '' }} autocomplete="off"> 
                                        <label class="btn btn-outline-success me-2" for="is_pinned1">Pinned</label> 

                                        <input type="radio" class="btn-check" name="is_pinned" id="is_pinned2" 
                                        value="0" {{ $post->is_pinned == 0 ? 'checked' : '' }} autocomplete="off"> 
                                        <label class="btn btn-outline-danger" for="is_pinned2">No Pin</label>
                                    </div> 
                                </div>
                            </div>
                            
                            {{-- Title --}}
                            <div class="row mb-3">
                                <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>
                                <div class="col-md-6">
                                    <input
                                        id="title"
                                        type="text"
                                        class="form-control @error('title') is-invalid @enderror"
                                        name="title"
                                        value="{{ old('title', $post->title) }}"
                                        autocomplete="off"
                                        autofocus
                                    >
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Slug --}}
                            <div class="row mb-3">
                                <label for="slug" class="col-md-4 col-form-label text-md-end">{{ __('Slug') }}</label>
                                <div class="col-md-6">
                                    <input
                                        id="slug"
                                        type="text"
                                        class="form-control @error('slug') is-invalid @enderror"
                                        name="slug"
                                        value="{{ old('slug', $post->slug) }}"
                                        readonly
                                    >
                                    @error('slug')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Content --}}
                            <div class="row mb-3">
                                <label for="content" class="col-md-4 col-form-label text-md-end">{{ __('Content') }}</label>
                                <div class="col-md-6">
                                    <input
                                        id="content"
                                        type="hidden"
                                        class="form-control @error('content') is-invalid @enderror"
                                        value="{{ old('content', $post->content) }}"
                                        content="content"
                                        autocomplete="off"
                                        autofocus
                                    >
                                    <textarea id="summernote" input="content" name="content">{{ old('content', $post->content) }}</textarea>
                                    @error('content')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Category --}}
                            <div class="row mb-3">
                                <label for="category" class="col-md-4 col-form-label text-md-end">{{ __('Category') }}</label>
                                <div class="col-md-6">
                                    @foreach ($categories as $category)
                                        <div class="btn-group form-check-inline" role="group" aria-label="Basic checkbox toggle button group">
                                            <input 
                                                type="checkbox" 
                                                name="categories[]" 
                                                class="btn-check" 
                                                id="categories_{{ $category->id }}" 
                                                value="{{ old('category', $category->id) }}" 
                                                {{ in_array($category->id, $post->category->pluck('id')->toArray()) ? 'checked' : '' }}
                                                autocomplete="off" 
                                            >
                                            <label class="btn btn-sm btn-outline-dark me-1" for="categories_{{ $category->id }}">{{ $category->name }}</label>
                                        </div>
                                    @endforeach
                                    @error('categories')
                                        <p class="text-danger d-flex fs-6 fw-bold">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            {{-- Tag --}}
                            <div class="row mb-3">
                                <label for="tag" class="col-md-4 col-form-label text-md-end">{{ __('Tags') }}</label>
                                <div class="col-md-6">
                                    @foreach ($tags as $tag)
                                        <div class="form-check form-check-inline">
                                            <input 
                                                class="form-check-input" 
                                                type="checkbox" 
                                                name="tags[]" 
                                                id="tag_{{ $tag->id }}" 
                                                value="{{ old('tag',$tag->id ) }}" 
                                                name="tag" 
                                                {{ in_array($tag->id, $post->tag->pluck('id')->toArray()) ? 'checked' : '' }}
                                            >
                                            <label class="form-check-label" for="tag_{{ $tag->id }}">{{ $tag->name }}</label>
                                        </div>
                                    @endforeach
                                    @error('tags')
                                        <p class="text-danger d-flex fs-6 fw-bold">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            {{-- postImages --}}
                            <div class="row mb-3">
                                <label for="postImages" class="col-md-4 col-form-label text-md-end">{{ __('Post Foto') }}</label>
                                <div class="col-md-6">
                                    <input
                                        name="postImages"
                                        class="form-control @error('postImages') is-invalid @enderror"
                                        value="{{ old('postImages', auth()->user()->postImages) }}"
                                        type="file"
                                        accept="postImages/*"
                                        id="formFile"
                                        onchange="loadFile(event)"
                                    >
                                    <img id="profile" src="{{ asset('storage/postImages/' . $post->postImages) }}" class="mt-3" width="200">
                                    @error('postImages')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Save --}}
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-dark">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>


            </div>
        </div>
    </div>




    <script>
        $('#summernote').summernote({
          placeholder: 'Content',
          tabsize: 2,
          height: 100
        });
    </script>
    <script src="{{ asset('js/preview.js') }}"></script>
    <script src="{{ asset('js/submit.js') }}"></script>
    <script src="{{ asset('js/slug.js') }}"></script>

@endsection
