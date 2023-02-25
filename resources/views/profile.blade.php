@extends('auth.app')


@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor/toastr/toastr.min.css') }}">
@endpush


@section('content')

<div class="container">
    <div class="row">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
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
            <div class="mt-3 me-3">
                {{-- <a href="{{ route('my.profile.index') }}" class="btn btn-large btn-success rounded-5"><i class="bi bi-pencil"></i></a> --}}
                <a href="#" class="btnn btn btn-large btn-success rounded-5" data-bs-toggle="modal" data-bs-target="#editModal{{ auth()->user()->id }}"><i class="bi bi-pencil"></i></a>
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




@include('includes.modal-editprofile')



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


@push('scripts')
    <script>
        $(document).ready(function() {
            // Ambil tombol edit dan tambahkan event listener
            $('a[data-bs-toggle="modal"]').on('click', function() {
                // Ambil id user dari data-bs-target
                let target = $(this).data('bs-target');
                let id = target.split('#editModal')[1];
                
                // Kirim permintaan AJAX ke server untuk mendapatkan data user
                $.ajax({
                url: '/users/' + id + '/edit',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    // Isi data user ke dalam form input fields
                    $('#editModal' + id).find('input[name="name"]').val(response.name);
                    $('#editModal' + id).find('input[name="email"]').val(response.email);
                    // Add more input fields as needed
                },
                error: function(error) {
                    console.log(error);
                }
                });
            });
        });


        const successMessage = "{{ session()->get('success') }}";
            if (successMessage) {
                toastr.success(successMessage)
            }
    </script>
    <script src="{{ asset('js/preview.js') }}"></script>
    <script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>
@endpush


@endsection
