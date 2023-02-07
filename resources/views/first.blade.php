@extends('layouts.app')

@section('content')
<div class="d-flex h-100 text-center">
    <div class="d-flex h-100 text-center cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    
    <main class="px-3">
        <h1 class="welcome"><b>Welcome</b></h1>
        <p class="lead fs-3">Sebelum Memuat Konten-konten. Mohon Login terlebih dahulu!</p>
        <p class="lead">
            <p><a href="/login" class="btn btn-outline-dark fw-bold">LOGIN</a>
            <b>     OR     </b>
            <a href="/register" class="btn btn-outline-dark fw-bold">REGISTER</a></p>
        </p>
    </main>

    </div>
</div>
@endsection