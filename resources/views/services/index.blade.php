@extends('layouts.app')
@section('title', 'Daftar Pelayanan')
@section('page-title', 'Daftar Pelayanan')
@section('breadcrumb')
<li class="breadcrumb-item active">Pelayanan</li>
@endsection

@section('actions')
<a href="{{ route('services.create') }}" class="btn btn-primary">
    <i class="fas fa-plus me-1"></i>Input Pelayanan
</a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="servicesTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Kategori</th>
                        <th>Subjek / Pelaporan</th>
                        <th>Pemilik Kapal</th>
                        <th>Kapal</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($services as $i => $s)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td class="text-nowrap">{{ $s->created_at->format('d/m/Y') }}</td>
                        <td>{{ $s->category }}</td>
                        <td>{{ Str::limit($s->subject, 50) }}</td>
                        <td>{{ $s->company->name ?? '-' }}</td>
                        <td>{{ $s->ship->name ?? '-' }}</td>
                        <td>
                            @if($s->status == 'submitted')
                                <span class="badge text-bg-warning fw-bold shadow-sm" style="border: 1px solid #e0a800;">
                                    <i class="fas fa-bell text-danger me-1"></i>Menunggu Kedatangan
                                </span>
                            @else
                                <span class="badge {{ $s->status == 'completed' ? 'text-bg-success' : 'text-bg-secondary' }}">
                                    {{ ucfirst(str_replace('_', ' ', $s->status)) }}
                                </span>
                            @endif
                        </td>
                        <td class="text-center text-nowrap">
                            <a href="{{ route('services.show', $s) }}" class="btn btn-xs btn-outline-primary" title="Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            @if($s->getWhatsappLink())
                            <a href="{{ $s->getWhatsappLink() }}" target="_blank" class="btn btn-xs btn-whatsapp" title="Kirim via WhatsApp">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(function() {
    $('#servicesTable').DataTable({
        order: [[1, 'desc']],
        columnDefs: [{ orderable: false, targets: -1 }]
    });
});
</script>
@endpush
