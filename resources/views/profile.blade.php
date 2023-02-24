@extends('auth.app')


@section('content')

<div class="container">
    <div class="row">

        
        <div class="card mb-3">
            
            {{-- Header --}}
            <div class="header">
                @if (auth()->user()->status == 'Active')
                    <p class="text-white mt-2 mx-3">Status : <b class="text-success fw-bold mt-2">{{ auth()->user()->status }}</b></p>
                @else
                    <p class="text-white mt-2 mx-3">Status : <b class="text-danger fw-bold mt-2">{{ auth()->user()->status }}</b></p>
                @endif
            </div>
            
            {{-- Profile Edit --}}
            <div class="d-flex justify-content-end mt-3 me-3">
                <a href="{{ route('my.profile.index') }}" class="btn btn-large btn-success rounded-5"><i class="bi bi-pencil"></i></a>
            </div>

            {{-- Profile Photo --}}
            <div class="profile d-flex justify-content-center">
                @if (auth()->user()->images)
                    <img src="{{ asset('storage/images/' . auth()->user()->images) }}" class="rounded rounded-circle shadow" alt="User Image" width="200" height="200" style="border: 3px white solid">
                @else
                    <img src="{{ asset('vendor/admin-lte/img/user-profile-default.jpg') }}" class="rounded rounded-circle shadow" alt="User Image" width="200" height="200" style="border: 3px white solid">
                @endif
            </div>
            
            {{-- Profile Detail --}}
            <div class="card-text pb-3">
                <p class="fs-4 text-center card-text"><small class="text-muted">{{ auth()->user()->role }}</small></p>
                <h1 class="card-text text-center"><b>{{ auth()->user()->name }}</b></h1>
                <p class="card-text fs-2 text-center"><small class="text-muted">{{ auth()->user()->email }}</small></p>
                <p class="card-text fs-4 text-muted mt-5">{{ auth()->user()->tanggal_lahir }} | {{ auth()->user()->jenis_kelamin }}</p>
                <p class="card-text fs-3">{{ auth()->user()->alamat }}</p>
            </div>

        </div>

        
    </div>
</div>








{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 text-center">
            <h1><b>{{ Auth::user()->name }}</b></h1>
            <h1>{{ Auth::user()->tanggal_lahir }}</h1>
            <h1>{{ Auth::user()->role }}</h1>
            <h1>{{ Auth::user()->jenis_kelamin }}</h1>
            <h1>{{ Auth::user()->alamat }}</h1>
            <h1>{{ Auth::user()->email }}</h1>
            <img src="{{ asset('storage/images/' . Auth::user()->images) }}" alt="Profile" width="500" class="rounded rounded-circle">
        </div> --}}





        {{-- <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div> 
    </div>
</div> --}}

@endsection
