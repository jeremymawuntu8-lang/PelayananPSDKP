<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — {{ config('app.name', 'PSDKP Pelayanan') }}</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')
</head>
<body style="background: var(--psdkp-bg);">

    {{-- Company Navbar --}}
    <nav class="company-nav">
        <div class="brand d-flex align-items-center">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 32px;" class="me-2">
            PSDKP <span class="ms-1">Pelayanan</span>
        </div>
        <div class="d-flex align-items-center gap-3">
            <div class="d-none d-md-block text-end">
                <div class="fw-semibold" style="font-size: 0.84rem;">{{ auth()->user()->name ?? '' }}</div>
                <div class="text-muted" style="font-size: 0.72rem;">Pemilik Kapal</div>
            </div>
            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'U') }}&background=0A5C6B&color=fff&size=36"
                 class="rounded-circle" width="36" height="36" alt="">
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button class="btn btn-sm btn-outline-secondary" type="submit">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </form>
        </div>
    </nav>

    {{-- Content --}}
    <div class="company-content">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@stack('scripts')
</body>
</html>
