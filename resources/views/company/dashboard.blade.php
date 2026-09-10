@extends('layouts.company')
@section('title', 'Dashboard')

@section('content')
<div class="row justify-content-center mb-4">
    <div class="col-lg-12">
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #0A3D6B 0%, #1565C0 100%); border-radius: 20px;">
            <div class="card-body py-5 px-4 text-white">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-white rounded-circle d-flex align-items-center justify-content-center me-3 shadow" style="width: 70px; height: 70px;">
                        <i class="fas fa-building text-primary" style="font-size: 2rem;"></i>
                    </div>
                    <div>
                        <h3 class="fw-bold mb-1 text-white">Selamat Datang, {{ auth()->user()->name }}</h3>
                        <p class="mb-0 opacity-75">Panel khusus pengelolaan pelayanan perikanan perusahaan Anda.</p>
                    </div>
                </div>
                
                @if(auth()->user()->company)
                <div class="mt-4 bg-white bg-opacity-10 rounded p-3 text-start">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-ship me-2 opacity-75"></i>
                                <span>Perusahaan: <strong>{{ auth()->user()->company->name }}</strong></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-envelope me-2 opacity-75"></i>
                                <span>Email: <strong>{{ auth()->user()->email }}</strong></span>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<h5 class="fw-bold mb-3 text-dark"><i class="fas fa-list-alt text-primary me-2"></i>Daftar Pelayanan Anda</h5>

<div class="row g-4">
    @forelse($services as $s)
    <div class="col-md-6 col-xl-4">
        <div class="card h-100 border-0 shadow-sm" style="border-radius: 16px; overflow: hidden; transition: transform 0.2s ease;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    @php
                        $badgeClass = match($s->status) {
                            'draft' => 'bg-secondary text-white',
                            'submitted' => 'bg-warning text-dark',
                            'completed' => 'bg-success text-white',
                            'cancelled' => 'bg-danger text-white',
                            default => 'bg-light text-dark'
                        };
                        $statusText = match($s->status) {
                            'draft' => 'Menunggu Tanggapan',
                            'submitted' => 'Sudah Ditanggapi',
                            'completed' => 'Selesai',
                            'cancelled' => 'Dibatalkan',
                            default => $s->status
                        };
                    @endphp
                    <span class="badge {{ $badgeClass }} px-3 py-2 rounded-pill" style="font-weight: 600;">
                        {{ $statusText }}
                    </span>
                    <small class="text-muted fw-semibold">
                        <i class="far fa-calendar-alt me-1"></i>{{ $s->created_at->format('d M Y') }}
                    </small>
                </div>
                
                <h5 class="fw-bold text-dark mb-2 line-clamp-2" style="min-height: 48px;">{{ $s->subject }}</h5>
                <p class="text-muted mb-3 fs-sm"><i class="fas fa-tag me-2 text-primary"></i>{{ $s->category }}</p>
                
                @if($s->ship)
                <div class="bg-light rounded p-2 mb-4">
                    <div class="d-flex align-items-center text-dark" style="font-size: 0.85rem; font-weight: 500;">
                        <i class="fas fa-anchor text-primary me-2"></i>
                        Kapal: {{ $s->ship->name }}
                    </div>
                </div>
                @else
                <div class="mb-4"></div>
                @endif
                
                <a href="{{ route('company.services.show', $s) }}" class="btn w-100 fw-bold shadow-sm" style="background-color: #f8fafc; border: 1px solid #e2e8f0; color: var(--ppsdk-primary); border-radius: 10px;">
                    <i class="fas fa-arrow-right me-2"></i> {{ $s->status === 'draft' ? 'Beri Tanggapan' : 'Lihat Detail' }}
                </a>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="border-radius: 16px;">
            <div class="card-body text-center py-5">
                <div class="mb-4">
                    <i class="fas fa-folder-open" style="font-size: 4rem; color: #cbd5e1;"></i>
                </div>
                <h5 class="fw-bold text-dark mb-2">Belum Ada Pelayanan</h5>
                <p class="text-muted mb-0" style="max-width: 500px; margin: 0 auto;">
                    Saat ini Anda belum memiliki data pelayanan yang terdaftar di sistem. Apabila ada pengawasan, Admin PSDKP akan membuatkan pelayanan untuk Anda.
                </p>
            </div>
        </div>
    </div>
    @endforelse
</div>
@endsection
