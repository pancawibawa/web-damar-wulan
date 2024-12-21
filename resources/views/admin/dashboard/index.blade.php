use Illuminate\Support\Facades\DB;
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


            <div class="col-lg-6 col-md-4">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content p-0">
                                    <div class="tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel">
                                        <div class="d-flex mb-6">
                                            <div class="avatar flex-shrink-0 me-3">
                                                <img src="{{ asset('sneat/img/icons/unicons/wallet.png') }}" alt="User">
                                            </div>
                                            <div>
                                                <p class="mb-0">Total Penghasilan</p>
                                                <div class="d-flex align-items-center">
                                                    <h6 class="mb-0 me-1">Rp {{ number_format($totalIncome, 0, ',', '.') }}
                                                    </h6>
                                                    <small class="text-success fw-medium">
                                                        <i class='bx bx-chevron-up bx-lg'></i>
                                                        42.9%
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Canvas untuk chart -->
                                        <canvas id="incomeChart" width="400" height="200"></canvas>

                                        <div class="d-flex align-items-center justify-content-center mt-6 gap-3">
                                            <div class="flex-shrink-0">
                                                <div id="expensesOfMonth"></div>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">Penghasilan Minggu ini</h6>
                                                <small>Rp {{ number_format($totalIncome / 4, 0, ',', '.') }} minggu</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Menambahkan Chart.js melalui CDN -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <script>
                // Data penghasilan bulanan yang dikirim dari controller
                const incomeData = @json($incomeData);

                // Membuat chart
                const ctx = document.getElementById('incomeChart').getContext('2d');
                const incomeChart = new Chart(ctx, {
                    type: 'line', // Jenis chart, bisa diubah menjadi 'bar', 'pie', dll
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov',
                        'Dec'], // Bulan
                        datasets: [{
                            label: 'Penghasilan per Bulan',
                            data: incomeData, // Data yang dikirim dari controller
                            borderColor: 'rgb(75, 192, 192)',
                            fill: false, // Tidak mengisi area di bawah garis
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: true,
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>

        </div>
    </div>
@endsection
