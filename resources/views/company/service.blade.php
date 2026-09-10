@extends('layouts.company')
@section('title', 'Detail Pelayanan')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="mb-4">
            <a href="{{ route('dashboard') }}" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i>Kembali ke Dashboard
            </a>
        </div>

        <div class="card mb-4 border-0 shadow-sm" style="border-top: 4px solid var(--psdkp-primary) !important;">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="badge badge-{{ $service->status }} fs-6 px-3 py-2">{{ ucfirst(str_replace('_', ' ', $service->status)) }}</span>
                    <small class="text-muted"><i class="fas fa-calendar-alt me-1"></i>{{ $service->created_at->format('d M Y') }}</small>
                </div>
                <h4 class="fw-bold mt-3 mb-1">{{ $service->subject }}</h4>
                <p class="text-muted mb-0"><i class="fas fa-tag me-2"></i>{{ $service->category }}</p>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-7">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-header bg-white fw-bold"><i class="fas fa-info-circle text-primary me-2"></i>Informasi Pelayanan</div>
                    <div class="card-body">
                        <table class="table table-borderless table-sm">
                            <tr>
                                <td width="160" class="text-muted">Nomor Kapal</td>
                                <td>: <span class="fw-semibold">{{ $service->ship->name ?? '-' }}</span></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Tanggal Pengamatan</td>
                                <td>: {{ $service->observation_date ? $service->observation_date->format('d F Y') : '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Indikasi</td>
                                <td>: <span class="text-danger fw-semibold">{{ $service->indikasi ?? '-' }}</span></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Keterangan Tambahan</td>
                                <td class="pre-wrap">: {{ $service->description ?? '-' }}</td>
                            </tr>
                        </table>

                        <hr>
                        
                        <h6 class="fw-bold mt-3 mb-3"><i class="fas fa-file-alt text-primary me-2"></i>Dokumen Terlampir</h6>
                        @if($service->documents->count() > 0)
                            <div class="list-group list-group-flush">
                            @foreach($service->documents as $doc)
                                <div class="list-group-item px-0 d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="fw-semibold">{{ $doc->type ?? 'Dokumen' }}</div>
                                        <div class="text-muted fs-xs">{{ $doc->nomor_surat ?? 'Tanpa Nomor Surat' }}</div>
                                    </div>
                                    <a href="{{ asset('storage/'.$doc->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-download"></i> Unduh
                                    </a>
                                </div>
                            @endforeach
                            </div>
                        @else
                            <p class="text-muted fst-italic">Tidak ada dokumen yang dilampirkan.</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white fw-bold"><i class="fas fa-reply text-primary me-2"></i>Tanggapan Anda</div>
                    <div class="card-body">
                        @if($service->company_response)
                            <div class="bg-primary-soft p-3 rounded-md mb-3">
                                <p class="mb-1">{{ $service->company_response }}</p>
                                <small class="text-muted d-block mt-2 border-top pt-2">
                                    <i class="fas fa-clock me-1"></i>Dikirim pada: {{ $service->responded_at ? $service->responded_at->format('d M Y, H:i') : '' }}
                                </small>
                            </div>
                            
                            @if(in_array($service->status, ['draft', 'need_revision', 'submitted']))
                            <button class="btn btn-outline-primary w-100" type="button" data-bs-toggle="collapse" data-bs-target="#responseForm">
                                <i class="fas fa-edit me-1"></i>Edit Tanggapan
                            </button>
                            <div class="collapse mt-3" id="responseForm">
                                <form action="{{ route('company.services.respond', $service) }}" method="POST">
                                    @csrf
                                    <textarea name="response" class="form-control mb-3" rows="4" required placeholder="Tuliskan tanggapan Anda di sini...">{{ $service->company_response }}</textarea>
                                    <button type="submit" class="btn btn-primary w-100">Kirim Tanggapan</button>
                                </form>
                            </div>
                            @endif
                        @else
                            <div class="alert alert-warning fs-sm mb-4">
                                <i class="fas fa-exclamation-circle me-1"></i>Anda belum memberikan tanggapan. Silakan isi form di bawah ini.
                            </div>
                            <form action="{{ route('company.services.respond', $service) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Tanggapan / Klarifikasi <span class="text-danger">*</span></label>
                                    <textarea name="response" class="form-control" rows="5" required placeholder="Tuliskan klarifikasi atau tanggapan Anda mengenai indikasi di atas..."></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-paper-plane me-1"></i>Kirim Tanggapan
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.pre-wrap { white-space: pre-wrap; word-break: break-word; }
</style>
@endpush
