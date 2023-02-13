@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('Edit Profile') }}</div>
                    <div class="card-body">
                        <form
                            action=""
                            method="POST"
                            enctype="multipart/form-data"
                        >
                            @method('put')
                            @csrf
                            
                            {{-- Name --}}
                            <div class="row mb-3">
                                <label
                                    for="name"
                                    class="col-md-4 col-form-label text-md-end"
                                >{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input
                                        id="name"
                                        type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        name="name"
                                        value="{{ $user->name }}"
                                    >

                                    @error('name')
                                        <span
                                            class="invalid-feedback"
                                            role="alert"
                                        >
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Tanggal Lahir --}}
                            <div class="row mb-3">
                                <label
                                    for="tanggal_lahir"
                                    class="col-md-4 col-form-label text-md-end"
                                >{{ __('Tanggal Lahir') }}</label>

                                <div class="col-md-6">
                                    <input
                                        id="tanggal_lahir"
                                        type="date"
                                        class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                        name="tanggal_lahir"
                                        value="{{ $user->tanggal_lahir }}"
                                    >

                                    @error('tanggal_lahir')
                                        <span
                                            class="invalid-feedback"
                                            role="alert"
                                        >
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Jenis Kelamin --}}
                            <div class="row mb-3">
                                <label
                                    for="jenis_kelamin"
                                    class="col-md-4 col-form-label text-md-end"
                                >{{ __('Jenis Kelamin') }}</label>

                                <div class="col-md-6">
                                    <select
                                        class="form-control @error('jenis_kelamin') is-invalid @enderror"
                                        aria-label="Default select example"
                                        name="jenis_kelamin"
                                    >
                                        <option
                                            {{ $user->jenis_kelamin === "Laki-Laki" ? 'selected' : '' }}
                                            value="Laki-Laki"
                                        >Laki-Laki</option>
                                        <option
                                            {{ $user->jenis_kelamin === "Perempuan" ? 'selected' : '' }}
                                            value="Perempuan"
                                        >Perempuan</option>
                                    </select>

                                    @error('jenis_kelamin')
                                        <span
                                            class="invalid-feedback"
                                            role="alert"
                                        >
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Alamat --}}
                            <div class="row mb-3">
                                <label
                                    for="alamat"
                                    class="col-md-4 col-form-label text-md-end"
                                >{{ __('Alamat') }}</label>

                                <div class="col-md-6">
                                    <textarea
                                        id="alamat"
                                        type="text"
                                        class="form-control @error('alamat') is-invalid @enderror"
                                        name="alamat"
                                    >{{ $user->alamat }}</textarea>

                                    @error('alamat')
                                        <span
                                            class="invalid-feedback"
                                            role="alert"
                                        >
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Status --}}
                            <div class="row mb-3">
                                <label
                                    for="status"
                                    class="col-md-4 col-form-label text-md-end"
                                >{{ __('Status') }}</label>

                                <div class="col-md-6">
                                    <select
                                        class="form-control @error('status') is-invalid @enderror"
                                        aria-label="Default select example"
                                        name="status"
                                    >
                                        <option
                                            {{ $user->status === "Active" ? 'selected' : '' }}
                                            value="Active"
                                        >Active</option>
                                        <option
                                            {{ $user->status === "Inactive" ? 'selected' : '' }}
                                            value="Inactive"
                                        >Block</option>
                                    </select>

                                    @error('status')
                                        <span
                                            class="invalid-feedback"
                                            role="alert"
                                        >
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Save --}}
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button
                                        type="submit"
                                        class="btn btn-dark"
                                    >
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
@endsection
