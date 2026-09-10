@extends('layouts.app')
@section('title', 'Data Kapal')
@section('page-title', 'Data Kapal')
@section('breadcrumb')
<li class="breadcrumb-item active">Data Kapal</li>
@endsection

@section('actions')
<a href="{{ route('ships.create') }}" class="btn btn-primary">
    <i class="fas fa-plus me-1"></i>Tambah Kapal
</a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="shipsTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kapal</th>
                        <th>Pemilik Kapal</th>
                        <th>Alat Tangkap</th>
                        <th>Pelabuhan Pangkal</th>
                        <th>PLB Terakhir</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ships as $i => $s)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td class="fw-semibold text-primary">{{ $s->name }}</td>
                        <td>{{ $s->company->name ?? '-' }}</td>
                        <td>{{ $s->fishing_gear ?? '-' }}</td>
                        <td>{{ $s->home_port ?? '-' }}</td>
                        <td>{{ $s->pelabuhan_keluar_terakhir ?? '-' }}</td>
                        <td class="text-center text-nowrap">
                            <a href="{{ route('ships.edit', $s) }}" class="btn btn-xs btn-outline-warning" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form id="deleteForm{{ $s->id }}" action="{{ route('ships.destroy', $s) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="button" class="btn btn-xs btn-outline-danger" onclick="confirmDelete('deleteForm{{ $s->id }}')" title="Hapus">
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
    $('#shipsTable').DataTable({
        columnDefs: [{ orderable: false, targets: -1 }]
    });
});
</script>
@endpush
