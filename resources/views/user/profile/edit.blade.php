@extends('layouts.main')

@section('konten')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Profil</h4>
                </div>
                <div class="card-body">
                    <!-- Form Edit Profil -->
                    <form action="{{ route('user.profileUpdate', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Input Nama -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" required>
                        </div>

                        <!-- Input Email (Read-Only) -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
                        </div>

                        <!-- Input Nomor HP -->
                        <div class="mb-3">
                            <label for="phone" class="form-label">Nomor HP</label>
                            <input type="text" name="phone" class="form-control" value="{{ Auth::user()->phone }}">
                        </div>

                        <!-- Input Alamat -->
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" name="alamat" class="form-control" value="{{ Auth::user()->alamat }}">
                        </div>

                        <!-- Input Foto Profil -->
                        <div class="mb-3">
                            <label for="image" class="form-label">Foto Profil</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary">Update Profil</button>
                    </form>
                    <!-- End of Form -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
