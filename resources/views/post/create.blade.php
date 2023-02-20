@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col">


                <div class="card">
                    <div class="card-header">{{ __('Crate Post') }}</div>
                    <div class="card-body">

                        <form action="{{ route('post.input') }}" method="POST" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            
                            {{-- Title --}}
                            <div class="row mb-3">
                                <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>
                                <div class="col-md-6">
                                    <input
                                        id="title"
                                        type="text"
                                        class="form-control @error('title') is-invalid @enderror"
                                        name="title"
                                        value="{{ old('title') }}"
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

                            {{-- Content --}}
                            <div class="row mb-3">
                                <label for="content" class="col-md-4 col-form-label text-md-end">{{ __('Content') }}</label>
                                @error('content')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                <div class="col-md-6">
                                    <input
                                        id="content"
                                        type="hidden"
                                        class="form-control @error('content') is-invalid @enderror"
                                        content="content"
                                        value="{{ old('content') }}"
                                        autocomplete="off"
                                        autofocus
                                    >
                                    <textarea id="summernote" input="content" name="content"></textarea>
                                </div>
                            </div>

                            {{-- postImages --}}
                            <div class="row mb-3">
                                <label for="postImages" class="col-md-4 col-form-label text-md-end">{{ __('Foto') }}</label>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <div>
                                            {{-- @if (auth()->user()->postImages)
                                                <img src="{{ Storage::url(auth()->user()->photo) }}" class="img-fluid mb-3 rounded">
                                            @endif --}}
                                            <input
                                                name="postImages"
                                                class="form-control @error('postImages') is-invalid @enderror"
                                                value="{{ old('postImages', auth()->user()->postImages) }}"
                                                type="file"
                                                accept="postImages/*"
                                                id="formFile"
                                            >
                                            <small for="formFile" class="form-label">{{ __('Silahkan Upload Foto Anda') }}</small>
                                        </div>
                                    </div>
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
                                        {{ __('Create') }}
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

@endsection
