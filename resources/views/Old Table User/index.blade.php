@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1><b>ALL USERS :</b></h1>
        </div>

        {{-- Alert --}}
        @if (session()->has('success'))
        <div class="alert alert-primary" role="alert">
            {{ session('success') }}
            <button  type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th scope="col" class="text-center">No.</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Jenis Kelamin</th>
                  <th scope="col">Tanggal Lahir</th>
                  <th scope="col" class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->jenis_kelamin }}</td>
                    <td>{{ $user->tanggal_lahir }}</td>
                    <td class="text-center">
                        <form action="/users/{{ $user->id }}" method="post">
                            @method('delete')
                            @csrf
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are You Sure?')"><i class="bi bi-trash3"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
              </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
