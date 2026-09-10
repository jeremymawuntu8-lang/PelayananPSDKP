@extends('layouts.app')
@section('title', 'Pemilik Kapal')
@section('page-title', 'Data Pemilik Kapal')
@section('breadcrumb')
<li class="breadcrumb-item active">Pemilik Kapal</li>
@endsection

@section('actions')
<a href="{{ route('companies.create') }}" class="btn btn-primary">
    <i class="fas fa-plus me-1"></i>Tambah Pemilik Kapal
</a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="companiesTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Perusahaan / Pemilik</th>
                        <th>Email</th>
                        <th>No. HP / WA</th>
                        <th>Total Kapal</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($companies as $i => $c)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td class="fw-semibold text-primary">{{ $c->name }}</td>
                        <td>{{ $c->email ?? '-' }}</td>
                        <td>
                            @if($c->phone)
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $c->phone) }}" target="_blank" class="text-success text-decoration-none">
                                <i class="fab fa-whatsapp me-1"></i>{{ $c->phone }}
                            </a>
                            @else
                            -
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-info-soft text-info">{{ $c->ships->count() }} Kapal</span>
                        </td>
                        <td class="text-center text-nowrap">
                            <a href="{{ route('companies.edit', $c) }}" class="btn btn-xs btn-outline-warning" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form id="deleteForm{{ $c->id }}" action="{{ route('companies.destroy', $c) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="button" class="btn btn-xs btn-outline-danger" onclick="confirmDelete('deleteForm{{ $c->id }}')" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
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
    $('#companiesTable').DataTable({
        columnDefs: [{ orderable: false, targets: -1 }]
    });
});
</script>
@endpush
