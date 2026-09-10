@extends('layouts.app')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
{{-- Stat Cards --}}
<div class="row g-3 mb-4">
    <div class="col-xl-3 col-md-6 col-6">
        <div class="stat-card stat-card-blue fade-in">
            <i class="fas fa-building stat-icon"></i>
            <div>
                <div class="stat-value">{{ $stats['companies'] }}</div>
                <div class="stat-label">Pemilik Kapal</div>
            </div>
            <div class="stat-footer">
                <a href="{{ route('companies.index') ?? '#' }}">Lihat detail <i class="fas fa-arrow-right ms-1"></i></a>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 col-6">
        <div class="stat-card stat-card-cyan fade-in">
            <i class="fas fa-ship stat-icon"></i>
            <div>
                <div class="stat-value">{{ $stats['ships'] }}</div>
                <div class="stat-label">Data Kapal</div>
            </div>
            <div class="stat-footer">
                <a href="{{ route('ships.index') ?? '#' }}">Lihat detail <i class="fas fa-arrow-right ms-1"></i></a>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 col-6">
        <div class="stat-card stat-card-amber fade-in">
            <i class="fas fa-clipboard-list stat-icon"></i>
            <div>
                <div class="stat-value">{{ $stats['total_services'] }}</div>
                <div class="stat-label">Total Pelayanan</div>
            </div>
            <div class="stat-footer">
                <a href="{{ route('services.index') }}">Lihat detail <i class="fas fa-arrow-right ms-1"></i></a>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 col-6">
        <div class="stat-card stat-card-green fade-in">
            <i class="fas fa-check-circle stat-icon"></i>
            <div>
                <div class="stat-value">{{ $stats['completed'] }}</div>
                <div class="stat-label">Selesai</div>
            </div>
            <div class="stat-footer">
                <a href="{{ route('services.index') }}">Lihat detail <i class="fas fa-arrow-right ms-1"></i></a>
            </div>
        </div>
    </div>
</div>

@if($upcomingArrivals->count() > 0)
<div class="card mb-4 border-warning shadow-sm" style="border-left: 5px solid #ffc107;">
    <div class="card-header bg-warning bg-opacity-10 text-dark fw-bold d-flex align-items-center justify-content-between">
        <span><i class="fas fa-bell text-warning me-2"></i>Jadwal Kedatangan Terdekat (Telah Dikonfirmasi)</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Tgl & Jam Kedatangan</th>
                        <th>Perusahaan / Kapal</th>
                        <th>Kehadiran</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($upcomingArrivals as $arr)
                    <tr>
                        <td>
                            <span class="badge bg-warning text-dark fw-bold mb-1">
                                <i class="fas fa-calendar-alt me-1"></i> {{ $arr->arrival_date->format('d M Y') }}
                            </span><br>
                            <span class="text-muted fs-sm"><i class="fas fa-clock me-1"></i> Pukul {{ $arr->arrival_time }}</span>
                        </td>
                        <td>
                            <div class="fw-bold">{{ $arr->company->name }}</div>
                            <div class="fs-sm text-muted"><i class="fas fa-ship me-1"></i> {{ $arr->ship->name ?? '-' }}</div>
                        </td>
                        <td>
                            @if($arr->attendance_type == 'pemilik')
                                <span class="badge bg-success bg-opacity-10 text-success"><i class="fas fa-user-tie me-1"></i> Pemilik</span>
                            @elseif($arr->attendance_type == 'nahkoda')
                                <span class="badge" style="background: rgba(2, 119, 189, 0.1); color: #0277BD; border: 1px solid rgba(2, 119, 189, 0.2);"><i class="fas fa-ship me-1"></i> Nahkoda</span>
                            @else
                                <span class="badge bg-info bg-opacity-10 text-info"><i class="fas fa-users me-1"></i> Diwakilkan</span>
                                <div class="fs-sm mt-1 text-muted">{{ $arr->attendance_notes }}</div>
                            @endif
                        </td>
                        <td class="text-end align-middle">
                            <a href="{{ route('services.show', $arr->id) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-file-alt me-1"></i> Lihat Dokumen
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif

{{-- Recent Services --}}
<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="fas fa-clock me-2 text-muted"></i>Pelayanan Terbaru</span>
        <a href="{{ route('services.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Kategori</th>
                        <th>Subjek</th>
                        <th>Pemilik</th>
                        <th>Kapal</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $s)
                    <tr>
                        <td class="text-nowrap">{{ $s->created_at->format('d/m/Y') }}</td>
                        <td>{{ $s->category }}</td>
                        <td>{{ Str::limit($s->subject, 40) }}</td>
                        <td>{{ $s->company->name ?? '-' }}</td>
                        <td>{{ $s->ship->name ?? '-' }}</td>
                        <td>
                            <span class="badge {{ $s->status == 'completed' ? 'text-bg-success' : ($s->status == 'submitted' ? 'text-bg-warning' : 'text-bg-primary') }}">
                                {{ ucfirst(str_replace('_', ' ', $s->status)) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('services.show', $s) }}" class="btn btn-xs btn-outline-primary">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">
                            <i class="fas fa-inbox d-block mb-2" style="font-size: 1.5rem;"></i>
                            Belum ada data pelayanan
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
