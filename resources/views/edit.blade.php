@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Update Profile') }}</div>

                <div class="card-body">
                    <form method="POST" action="/update/users/submit" autocomplete="off" enctype="multipart/form-data"> {{-- enctype="multipart/form-data" : agar data luar bisa masuk --}}
                        @csrf

                        {{-- Name --}}
                        <div class="row mb-3">
                            <label for="nama" class="col-md-4 col-form-label text-md-end">{{ __('Nama') }}</label>

                            <div class="col-md-6">
                                <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama', Auth::user()->nama) }}" autocomplete="nama">

                                @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        




                        {{-- Alamat --}}
                        <div class="row mb-3">
                            <label for="alamat" class="col-md-4 col-form-label text-md-end">{{ __('Tempat Tinggal') }}</label>

                            <div class="col-md-6">
                                <input id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{ old('alamat',Auth::user()->alamat) }}" autocomplete="alamat">

                                @error('alamat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- tanggal_lahir --}}
                        <div class="row mb-3">
                            <label for="tanggal_lahir" class="col-md-4 col-form-label text-md-end">{{ __('Tanggal Lahir') }}</label>

                            <div class="col-md-6">
                                <input id="tanggal_lahir" type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" value="{{ old('tanggal_lahir', Auth::user()->tanggal_lahir) }}" autocomplete="tanggal_lahir">

                                @error('tanggal_lahir')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- jenis_kelamin --}}
                        <div class="row mb-3">
                            <label for="jenis_kelamin" class="col-md-4 col-form-label text-md-end">{{ __('Jenis Kelamin') }}</label>

                            <div class="col-md-6">
                                <select id="jenis_kelamin" name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror">
                                    <option value="Session::get('jenis_kelamin')" disabled hidden selected>Pilih Jenis Kelamin</option>
                                    <option value="Pria" {{ (Auth::user()->jenis_kelamin === "Pria") ? 'selected' : '' }} >Pria</option>
                                    <option value="Wanita" {{ (Auth::user()->jenis_kelamin === "Wanita") ? 'selected' : '' }} >Wanita</option>
                                    <option value="Privasi" {{ (Auth::user()->jenis_kelamin === "Privasi") ? 'selected' : '' }} >Privasi</option>
                                </select>

                                @error('jenis_kelamin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        {{-- Role --}}
                        {{-- <div class="row mb-3">
                            <label for="role" class="col-md-4 col-form-label text-md-end">{{ __('Role') }}</label>

                            <div class="col-md-6">
                                <select id="role" name="role" class="form-control @error('role') is-invalid @enderror">
                                    <option value="" disabled hidden selected>Pilih Role</option>
                                    <option value="superadmin">superadmin</option>
                                    <option value="admin">admin</option>
                                </select>

                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}

                        {{-- gambar --}}
                        <div class="mt-3">
                            <img class="outimg" width="200" src="" id="output"> {{-- output --}}
                        </div>
                        <div class="row mb-3">
                            <label for="gambar" class="col-md-4 col-form-label text-md-end">{{ __('gambar') }}</label>

                            <div class="col-md-6">
                                <input id="gambar" type="file" class="form-control @error('gambar') is-invalid @enderror" name="gambar" autocomplete="gambar" accept="gambar/*" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">

                                @error('gambar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        {{-- update tombol  --}}
                        {{-- <button class="button-56" role="button">Button 56</button> --}}
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
@endsection