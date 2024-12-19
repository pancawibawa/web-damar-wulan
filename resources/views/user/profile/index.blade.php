@extends('layouts.main')
@section('konten')
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-lg-8 mb-4 mb-lg-0">
                <div class="card mb-3" style="border-radius: .5rem;">
                    <div class="row g-0">
                        <div class="col-md-4 gradient-custom text-center text-dark"
                            style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                            <img src="{{ asset('storage/profile_images/' . Auth::user()->image) }}"
                                alt="Avatar" class="img-fluid my-5" style="width: 80px;" />
                            <h5>{{ Auth::user()->name }}</h5>
                            <p style="color: rgb(230, 186, 27);">Member Gold</p>
                            <a href="{{route('user.profileEdit', Auth::user()->id)}}"><i class="far fa-edit mb-5"> Edit</i></a>

                        </div>
                        <div class="col-md-8">
                            <div class="card-body p-4">
                                <h6>Informasi Akun</h6>
                                <hr class="mt-0 mb-4">
                                <div class="row pt-1">
                                    <div class="col-6 mb-3">
                                        <h6>Email</h6>
                                        <p class="text-muted">{{Auth::user()->email}}</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <h6>No.Hp</h6>
                                        <p class="text-muted">{{Auth::user()->phone}}</p>
                                    </div>
                                </div>
                                <h6>Informasi Alamat</h6>
                                <hr class="mt-0 mb-4">
                                <div class="row pt-1">
                                    <div class="col-6 mb-3">
                                        <h6>Alamat Lengkap</h6>
                                        <p class="text-muted">{{Auth::user()->alamat}}</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <h6>Total Belanja</h6>
                                        <p class="text-muted">{{Auth::user()->email}}</p>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
@endsection
