<!DOCTYPE html>
<html>

<head>
    <title>Web Damar Wulan</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="stylesheet" type="text/css" href="{{asset('asset/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('asset/style.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500&family=Lato:wght@300;400;700&display=swap"
        rel="stylesheet">
    <!-- Link ke Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <script src="asset/js/modernizr.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true"
    tabindex="0">
    
    <title>Search</title>
    @include('layouts.search')

    <header id="header" class="site-header header-scrolled position-fixed text-black bg-light"
        style="width: 100%; top: 0; z-index: 1000;">
        @include('layouts.header')
    </header>
    @if (session()->has('success'))
        <script>
            // Menampilkan SweetAlert2 setelah halaman dimuat
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    position: 'top-end', // Posisi di pojok kanan atas
                    icon: 'success', // Ikon sukses
                    title: '{{ session('success') }}', // Pesan sukses
                    showConfirmButton: false, // Tidak menampilkan tombol konfirmasi
                    timer: 3000, // Waktu tampil 3 detik
                    toast: true, // Menggunakan mode toast
                    background: '#28a745', // Warna latar belakang hijau
                    color: 'white', // Warna teks putih
                    timerProgressBar: true, // Menampilkan progress bar
                });
            });
        </script>
    @endif
    <section style="margin-top: 80px;">
        @yield('konten')
    </section>

    <footer id="footer" class="overflow-hidden">
        @include('layouts.footer')
    </footer>

    <script src="asset/js/jquery-1.11.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script type="text/javascript" src="asset/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="asset/js/plugins.js"></script>
    <script type="text/javascript" src="asset/js/script.js"></script>
</body>

</html>
