<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!-- Tambahkan CSS SweetAlert -->
        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
        {{-- bootstrap --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
        {{-- My Css --}}
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Tambahkan CSS SweetAlert -->
        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 flex">

            <!-- Sidebar -->
            <aside class="sidebar w-56 shadow-md hidden lg:block bg-gray-800">
                <div class="px-6 py-3 border-b border-gray-700">
                    <h1 class="text-xl font-semibold text-gray-200">User Role</h1>
                </div>
                <nav class="mt-4">
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('dashboard') }}" class="flex items-center px-6 py-2 text-gray-200 hover:text-gray-400 transition-all duration-200 transform hover:scale-105">
                                <span class="material-icons me-2">dashboard</span>
                                Dashboard
                            </a>
                        </li>

                        @if (auth()->user()->hasRole('admin'))
                        <li>
                            <a href="{{ route('users.index') }}" class="flex items-center px-6 py-2 text-gray-200 hover:text-gray-400 transition-all duration-200 transform hover:scale-105">
                                <span class="material-icons me-2">group</span>
                                Users
                            </a>
                        </li>
                        @endif
                    </ul>
                </nav>
            </aside>

    
            <!-- Main Content -->
            <div class="flex-1 flex flex-col">
                <!-- Original Content -->
                <div>
                    @include('layouts.navigation')
    
                    <!-- Page Heading -->
                    @isset($header)
                        <header class="bg-white shadow">
                            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                                {{ $header }}
                            </div>
                        </header>
                    @endisset
    
                    <!-- Page Content -->
                    <main>
                        {{ $slot }}
                    </main>
                </div>
            </div>
        </div>
    </body>
    
</html>

{{-- sweet alert --}}
@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session("success") }}',
        timer: 2000,
        showConfirmButton: true
    });
</script>
@endif

@if (session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: '{{ session("error") }}',
        timer: 2000,
        showConfirmButton: true
    });
</script>

<script>
    // ribuan handler
    function formatThousand(input) {
    // Ambil nilai input tanpa format
    let rawValue = input.value.replace(/\D/g, '');

    // Simpan nilai asli tanpa format di atribut data-raw
    input.dataset.raw = rawValue;

    // Format angka dengan pemisah ribuan
    input.value = new Intl.NumberFormat('id-ID').format(rawValue);
    }

</script>
@endif
