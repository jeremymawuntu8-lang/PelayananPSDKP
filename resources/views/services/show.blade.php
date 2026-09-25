@extends('layouts.app')
@section('title', 'Detail Pelayanan')
@section('page-title', 'Detail Pelayanan')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('services.index') }}">Pelayanan</a></li>
<li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')
<div class="row g-3">
    {{-- Left Column: Details --}}
    <div class="col-lg-8">
        {{-- Status Card --}}
        <div class="card mb-3 border-0 shadow-sm" style="border-top: 4px solid var(--psdkp-primary) !important;">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="badge {{ $service->status == 'completed' ? 'text-bg-success' : ($service->status == 'submitted' ? 'text-bg-warning' : 'text-bg-primary') }} fs-6 px-3 py-2">
                        {{ ucfirst(str_replace('_', ' ', $service->status)) }}
                    </span>
                    @if($service->getWhatsappLink())
                    <a href="{{ $service->getWhatsappLink() }}" target="_blank" class="btn btn-whatsapp">
                        <i class="fab fa-whatsapp me-2"></i>Kirim Link via WA
                    </a>
                    @endif
                </div>
                <h4 class="fw-bold mt-3 mb-1">{{ $service->subject }}</h4>
                <p class="text-muted mb-0"><i class="fas fa-tag me-2"></i>{{ $service->category }} | <strong>Token:</strong> {{ $service->token }}</p>
            </div>
        </div>

        {{-- 1. Objek Pelaporan --}}
        <div class="detail-section">
            <div class="detail-section-header">
                <i class="fas fa-ship"></i> 1. Objek Pelaporan
            </div>
            <div class="detail-section-body">
                <div class="detail-row">
                    <div class="detail-label">Pemilik Kapal</div>
                    <div class="detail-value fw-semibold">{{ $service->company->name ?? '-' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Nama Kapal</div>
                    <div class="detail-value fw-semibold">{{ $service->ship?->name ?? '-' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">No Transmitter</div>
                    <div class="detail-value">{{ $service->ship?->transmitter_no ?? '-' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">No Buku Kapal</div>
                    <div class="detail-value">{{ $service->ship?->book_no ?? '-' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Jenis Alat Tangkap</div>
                    <div class="detail-value">{{ $service->ship?->fishing_gear ?? '-' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Ukuran (GT)</div>
                    <div class="detail-value">{{ $service->ship?->size ?? '-' }}</div>
                </div>
            </div>
        </div>

        {{-- 2. Analysis --}}
        <div class="detail-section">
            <div class="detail-section-header teal">
                <i class="fas fa-search"></i> 2. Analysis
            </div>
            <div class="detail-section-body">
                <div class="detail-row">
                    <div class="detail-label">Lembar Indikasi</div>
                    <div class="detail-value">{{ $service->lembar_indikasi ?? '-' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Indikasi</div>
                    <div class="detail-value fw-semibold text-danger">{{ $service->indikasi ?? '-' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">ANALYSIS (Deskripsi)</div>
                    <div class="detail-value pre-wrap">{{ $service->analysis ?? '-' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Analyst</div>
                    <div class="detail-value">{{ $service->analyst ?? '-' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Verificator</div>
                    <div class="detail-value">{{ $service->verificator ?? '-' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Unit Kerja</div>
                    <div class="detail-value">{{ $service->unit_kerja ?? '-' }}</div>
                </div>
            </div>
        </div>

        {{-- 3. Perizinan --}}
        <div class="detail-section">
            <div class="detail-section-header bg-success text-white">
                <i class="fas fa-file-signature"></i> 3. Perizinan
            </div>
            <div class="detail-section-body">
                <div class="detail-row">
                    <div class="detail-label">No SIPI</div>
                    <div class="detail-value">{{ $service->ship?->sipi_no ?? '-' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Periode SIPI</div>
                    <div class="detail-value">
                        {{ $service->ship?->sipi_start ? \Carbon\Carbon::parse($service->ship?->sipi_start)->format('d M Y') : '-' }} s.d 
                        {{ $service->ship?->sipi_end ? \Carbon\Carbon::parse($service->ship?->sipi_end)->format('d M Y') : '-' }}
                    </div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">DPI</div>
                    <div class="detail-value">{{ $service->ship?->dpi ?? '-' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Pelabuhan Pangkalan</div>
                    <div class="detail-value">{{ $service->ship?->home_port ?? '-' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Penerbit SLO</div>
                    <div class="detail-value">{{ $service->ship?->slo_issuer ?? '-' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Jenis Izin</div>
                    <div class="detail-value">{{ $service->ship?->license_type ?? '-' }}</div>
                </div>
            </div>
        </div>

        {{-- 4. Indikasi Pelanggaran --}}
        <div class="detail-section">
            <div class="detail-section-header orange">
                <i class="fas fa-exclamation-triangle"></i> 4. Ditemukan Indikasi Pelanggaran
            </div>
            <div class="detail-section-body">
                <div class="detail-row">
                    <div class="detail-label">Indikasi Pelanggaran</div>
                    <div class="detail-value text-danger">{{ $service->indikasi_pelanggaran ?? '-' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Duga Langgar</div>
                    <div class="detail-value pre-wrap">{{ $service->duga_langgar ?? '-' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Period Violation</div>
                    <div class="detail-value">
                        {{ $service->period_violation_start ? $service->period_violation_start->format('d/m/Y') : '-' }} s.d 
                        {{ $service->period_violation_end ? $service->period_violation_end->format('d/m/Y') : '-' }}
                    </div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Pelabuhan Keluar Terakhir</div>
                    <div class="detail-value">{{ $service->pelabuhan_keluar_terakhir ?? '-' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Mulai Melanggar</div>
                    <div class="detail-value">{{ $service->mulai_melanggar ? $service->mulai_melanggar->format('d M Y') : '-' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Frekuensi Pelanggaran</div>
                    <div class="detail-value">{{ $service->frekuensi_pelanggaran ? $service->frekuensi_pelanggaran . ' kali' : '-' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">UPT Terdekat</div>
                    <div class="detail-value">
                        {{ $service->upt_terdekat ?? '-' }}
                        @php
                            $uptMaps = [
                                'Bitung' => 'https://maps.app.goo.gl/ZxwduNteqVcL12Th6?g_st=aw',
                            ];
                        @endphp
                        @if($service->upt_terdekat && isset($uptMaps[$service->upt_terdekat]))
                            <a href="{{ $uptMaps[$service->upt_terdekat] }}" target="_blank" class="btn btn-sm btn-outline-primary ms-2" style="font-size: 0.75rem;">
                                <i class="fas fa-map-marker-alt me-1"></i>Lihat Maps
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- 5. Surat Analisis DIR POA & Dokumen --}}
        <div class="detail-section">
            <div class="detail-section-header bg-secondary text-white">
                <i class="fas fa-file-alt"></i> 5. Surat Analisis DIR POA & Dokumen
            </div>
            <div class="detail-section-body">
                <div class="detail-row">
                    <div class="detail-label">Nomor Surat Analisis</div>
                    <div class="detail-value fw-semibold">{{ $service->surat_analisis_nomor ?? '-' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">SKAT Nomor</div>
                    <div class="detail-value">{{ $service->skat_nomor ?? '-' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Masa Berlaku</div>
                    <div class="detail-value">{{ $service->masa_berlaku ? \Carbon\Carbon::parse($service->masa_berlaku)->format('d M Y') : '-' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Titik Lokasi (Koordinat)</div>
                    <div class="detail-value">
                        @if($service->latitude && $service->longitude)
                        {{ $service->latitude }}, {{ $service->longitude }}
                        <a href="https://maps.google.com/?q={{ $service->latitude }},{{ $service->longitude }}" target="_blank" class="ms-2 btn btn-xs btn-outline-primary"><i class="fas fa-map-marker-alt"></i> Buka Map</a>
                        @else
                        -
                        @endif
                    </div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Tanggal Pengamatan</div>
                    <div class="detail-value">{{ $service->observation_date ? $service->observation_date->format('d M Y') : '-' }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Right Column: Timeline & Respon --}}
    <div class="col-lg-4">
        {{-- Tanggapan Company --}}
        <div class="card mb-3 border-0 shadow-sm">
            <div class="card-header bg-white fw-bold"><i class="fas fa-comments me-2 text-primary"></i>Tanggapan Pemilik Kapal</div>
            <div class="card-body">
                @if($service->status !== 'draft' && $service->status !== 'waiting_company')
                    
                    {{-- Alasan Melanggar --}}
                    <div class="mb-3">
                        <div class="fw-semibold text-muted mb-1" style="font-size: 0.85rem;"><i class="fas fa-exclamation-circle me-1 text-warning"></i> Alasan Utama Melanggar</div>
                        @if($service->violation_reasons)
                            <div class="d-flex flex-wrap gap-1 mt-1">
                                @php
                                    $reasonLabels = [
                                        'ketidaktahuan_aturan' => 'Ketidaktahuan aturan',
                                        'ketidaktahuan_batas_wilayah' => 'Ketidaktahuan batas wilayah',
                                        'cuaca_buruk' => 'Cuaca buruk',
                                        'mengantar_logistik' => 'Mengantar Logistik',
                                        'kerusakan_kapal' => 'Kerusakan kapal',
                                        'abk_sakit' => 'ABK sakit',
                                        'kondisi_darurat' => 'Kondisi darurat',
                                        'lainnya' => 'Lainnya',
                                    ];
                                    $vReasons = explode(',', $service->violation_reasons);
                                @endphp
                                @foreach($vReasons as $vr)
                                    <span class="badge bg-warning bg-opacity-10 text-warning border border-warning-subtle" style="font-size: 0.75rem;">
                                        {{ $reasonLabels[$vr] ?? $vr }}
                                    </span>
                                @endforeach
                            </div>
                        @else
                            <span class="text-muted fs-sm">-</span>
                        @endif
                    </div>

                    {{-- Keterangan Lainnya --}}
                    @if($service->violation_other)
                    <div class="mb-3">
                        <div class="fw-semibold text-muted mb-1" style="font-size: 0.85rem;"><i class="fas fa-align-left me-1 text-info"></i> Keterangan Lainnya</div>
                        <div class="bg-light p-2 rounded border border-light-subtle fs-sm pre-wrap">{{ $service->violation_other }}</div>
                    </div>
                    @endif

                    {{-- Rencana Kehadiran --}}
                    <div class="mb-3">
                        <div class="fw-semibold text-muted mb-1" style="font-size: 0.85rem;"><i class="fas fa-users me-1 text-success"></i> Rencana Kehadiran</div>
                        @if($service->attendance_type)
                            <div class="d-flex flex-wrap gap-1 mt-1 mb-2">
                                @php $attendances = explode(',', $service->attendance_type); @endphp
                                @if(in_array('pemilik', $attendances))
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success-subtle"><i class="fas fa-user-tie me-1"></i>Pemilik</span>
                                @endif
                                @if(in_array('nahkoda', $attendances))
                                    <span class="badge bg-info bg-opacity-10 text-info border border-info-subtle"><i class="fas fa-ship me-1"></i>Nahkoda</span>
                                @endif
                                @if(in_array('diwakilkan', $attendances))
                                    <span class="badge bg-primary bg-opacity-10 text-primary border border-primary-subtle"><i class="fas fa-users me-1"></i>Diwakilkan</span>
                                @endif
                            </div>
                            @if(in_array('diwakilkan', $attendances) && $service->attendance_notes)
                                <div class="bg-light p-2 rounded border border-light-subtle fs-sm">
                                    <span class="fw-semibold text-muted"><i class="fas fa-arrow-right me-1"></i>Diwakilkan Oleh:</span> {{ $service->attendance_notes }}
                                </div>
                            @endif
                        @else
                            <span class="text-muted fs-sm">-</span>
                        @endif
                    </div>

                    {{-- Klarifikasi Tambahan --}}
                    <div class="mb-2">
                        <div class="fw-semibold text-muted mb-1" style="font-size: 0.85rem;"><i class="fas fa-comment-dots me-1 text-secondary"></i> Klarifikasi Tambahan</div>
                        @if($service->company_response)
                            <div class="bg-primary bg-opacity-10 p-3 rounded border border-primary-subtle fs-sm pre-wrap">{{ $service->company_response }}</div>
                        @else
                            <span class="text-muted fs-sm">-</span>
                        @endif
                    </div>
                    
                    <hr>
                    <div class="text-end text-muted fs-xs">
                        <i class="fas fa-clock me-1"></i> Direspon pada: {{ $service->responded_at ? $service->responded_at->format('d M Y H:i') : '-' }}
                    </div>

                @else
                <div class="empty-state py-4 text-center">
                    <i class="fas fa-comment-slash text-muted mb-2" style="font-size: 2rem;"></i>
                    <div class="text-muted fw-semibold">Belum ada tanggapan</div>
                    <div class="text-muted fs-sm">Pemilik kapal belum mengisi formulir.</div>
                </div>
                @endif
            </div>
        </div>

        {{-- Timeline / Dokumen --}}
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white"><i class="fas fa-history me-2 text-primary"></i>Riwayat & Dokumen</div>
            <div class="card-body">
                <ul class="timeline">
                    {{-- Created --}}
                    <li class="timeline-item">
                        <div class="timeline-icon document"><i class="fas fa-plus"></i></div>
                        <div class="timeline-date">{{ $service->created_at ? $service->created_at->format('d M Y H:i') : '-' }}</div>
                        <div class="timeline-content">
                            <div class="fw-bold fs-sm">Pelayanan Dibuat</div>
                            <div class="text-muted fs-xs">Oleh: {{ $service->creator->name ?? 'Sistem' }}</div>
                        </div>
                    </li>

                    {{-- Documents --}}
                    @foreach($service->documents as $doc)
                    <li class="timeline-item">
                        <div class="timeline-icon mail"><i class="fas fa-file-pdf"></i></div>
                        <div class="timeline-date">{{ $doc->created_at ? $doc->created_at->format('d M Y H:i') : '-' }}</div>
                        <div class="timeline-content">
                            <div class="fw-bold fs-sm">{{ $doc->type ?? 'Dokumen Tambahan' }}</div>
                            @if($doc->nomor_surat)
                            <div class="text-primary fs-xs mb-1">{{ $doc->nomor_surat }}</div>
                            @endif
                            <a href="{{ asset('storage/'.$doc->file_path) }}" target="_blank" class="btn btn-xs btn-outline-primary mt-1">
                                <i class="fas fa-download me-1"></i>Unduh
                            </a>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.pre-wrap { white-space: pre-wrap; word-break: break-word; }

/* Detail Section */
.detail-section {
    background: #fff;
    border-radius: 0.75rem;
    box-shadow: 0 2px 10px rgba(0,0,0,0.03);
    margin-bottom: 1.5rem;
    overflow: hidden;
}
.detail-section-header {
    background: #0A3D6B; /* Default primary */
    color: #fff;
    padding: 0.75rem 1.25rem;
    font-weight: 700;
    font-size: 0.95rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.detail-section-header.teal { background: #0D9488; }
.detail-section-header.orange { background: #EA580C; }

.detail-section-body {
    padding: 0;
}
.detail-row {
    display: flex;
    padding: 0.85rem 1.25rem;
    border-bottom: 1px solid #F3F4F6;
    align-items: flex-start;
}
.detail-row:last-child { border-bottom: none; }
.detail-label {
    flex: 0 0 40%;
    max-width: 200px;
    color: #6B7280;
    font-weight: 600;
    font-size: 0.85rem;
}
.detail-value {
    flex: 1;
    color: #1F2937;
    font-size: 0.9rem;
}

/* Timeline */
.timeline {
    list-style: none;
    padding: 0;
    margin: 0;
    position: relative;
}
.timeline::before {
    content: '';
    position: absolute;
    left: 14px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #E5E7EB;
}
.timeline-item {
    position: relative;
    padding-left: 2.5rem;
    margin-bottom: 1.5rem;
}
.timeline-item:last-child { margin-bottom: 0; }
.timeline-icon {
    position: absolute;
    left: 0;
    top: 0;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background: #E5E7EB;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 0.75rem;
    z-index: 1;
}
.timeline-icon.document { background: #3B82F6; }
.timeline-icon.mail { background: #10B981; }

.timeline-date {
    font-size: 0.75rem;
    color: #6B7280;
    margin-bottom: 0.25rem;
}
.timeline-content {
    background: #F9FAFB;
    padding: 0.75rem;
    border-radius: 0.5rem;
    border: 1px solid #F3F4F6;
}

/* Custom utility colors */
.bg-primary-soft { background-color: rgba(10, 61, 107, 0.05); }
.text-bg-primary { background-color: #0A3D6B !important; color: #fff !important; }
</style>
@endpush

@push('scripts')
@if(session('open_wa_link'))
<script>
    document.addEventListener("DOMContentLoaded", function() {
        window.open("{{ session('open_wa_link') }}", "_blank");
    });
</script>
@endif
@endpush
