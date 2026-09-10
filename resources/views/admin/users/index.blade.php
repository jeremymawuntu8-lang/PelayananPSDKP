@extends('layouts.app')
@section('title', 'Manajemen User')
@section('page-title', 'Manajemen User')
@section('breadcrumb')
<li class="breadcrumb-item active">Users</li>
@endsection

@section('actions')
<a href="{{ route('users.create') }}" class="btn btn-primary">
    <i class="fas fa-user-plus me-1"></i>Tambah User
</a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="usersTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Terkait Company</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $i => $u)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td class="fw-semibold">{{ $u->name }}</td>
                        <td>{{ $u->email }}</td>
                        <td>
                            <span class="badge {{ $u->role == 'admin' ? 'bg-primary' : ($u->role == 'petugas' ? 'bg-info' : 'bg-secondary') }}">
                                {{ strtoupper($u->role) }}
                            </span>
                        </td>
                        <td>{{ $u->company->name ?? '-' }}</td>
                        <td class="text-center text-nowrap">
                            <a href="{{ route('users.edit', $u) }}" class="btn btn-xs btn-outline-warning" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            @if($u->id !== auth()->id())
                            <form id="deleteForm{{ $u->id }}" action="{{ route('users.destroy', $u) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="button" class="btn btn-xs btn-outline-danger" onclick="confirmDelete('deleteForm{{ $u->id }}')" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
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
    $('#usersTable').DataTable({
        columnDefs: [{ orderable: false, targets: -1 }]
    });
});
</script>
@endpush
