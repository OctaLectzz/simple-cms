@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 text-center">
            <h1><b>{{ Auth::user()->name }}</b></h1>
            <h1>{{ Auth::user()->tanggal_lahir }}</h1>
            <h1>{{ Auth::user()->role }}</h1>
            <h1>{{ Auth::user()->jenis_kelamin }}</h1>
            <h1>{{ Auth::user()->alamat }}</h1>
            <h1>{{ Auth::user()->email }}</h1>
            <img src="{{ asset('storage/images/' . Auth::user()->images) }}" alt="Profile" width="500" class="rounded rounded-circle">
        </div>





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
        </div> --}}
    </div>
</div>
@endsection
