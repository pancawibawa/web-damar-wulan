@extends('layoutadmin.app')
@section('konten')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <!-- Total Produk -->
        <div class="col-lg-4 col-md-4">
            <div class="row ">
                <div class="col-lg-12 col-md-12 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <span class="fw-semibold d-block mb-1">Produk</span>
                            <h4 class="mb-0">{{ $totalProduk }}</h4> <!-- Total Produk -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Order -->
        <div class="col-lg-4 col-md-4">
            <div class="row ">
                <div class="col-lg-12 col-md-12 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <span class="fw-semibold d-block mb-1">Order</span>
                            <h4 class="mb-0">{{ $totalOrder }}</h4> <!-- Total Order -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Berhasil -->
        <div class="col-lg-4 col-md-4">
            <div class="row ">
                <div class="col-lg-12 col-md-12 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <span class="fw-semibold d-block mb-1">Berhasil</span>
                            <h4 class="mb-0">{{ $totalBerhasil }}</h4> <!-- Total Berhasil -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection