@extends('layouts.app')
@section('title', isset($user) ? 'Edit User' : 'Tambah User')
@section('page-title', isset($user) ? 'Edit User' : 'Tambah User')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
<li class="breadcrumb-item active">{{ isset($user) ? 'Edit' : 'Tambah' }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-body">
                <form action="{{ isset($user) ? route('users.update', $user) : route('users.store') }}" method="POST">
                    @csrf
                    @if(isset($user)) @method('PUT') @endif
                    
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name ?? '') }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email ?? '') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password {!! isset($user) ? '<small class="text-muted fw-normal">(Kosongkan jika tidak ingin diubah)</small>' : '<span class="text-danger">*</span>' !!}</label>
                        <input type="password" name="password" class="form-control" {{ isset($user) ? '' : 'required' }}>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Role <span class="text-danger">*</span></label>
                        <select name="role" class="form-select" id="roleSelect" required>
                            <option value="petugas" {{ old('role', $user->role ?? '') == 'petugas' ? 'selected' : '' }}>Petugas</option>
                            <option value="admin" {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="company" {{ old('role', $user->role ?? '') == 'company' ? 'selected' : '' }}>Company / Pemilik Kapal</option>
                        </select>
                    </div>

                    <div class="mb-4" id="companySelectDiv" style="{{ old('role', $user->role ?? '') == 'company' ? '' : 'display:none;' }}">
                        <label class="form-label">Pilih Perusahaan <span class="text-danger">*</span></label>
                        <select name="company_id" class="form-select select2">
                            <option value="">-- Pilih Perusahaan --</option>
                            @foreach(\App\Models\Company::all() as $c)
                            <option value="{{ $c->id }}" {{ old('company_id', $user->company_id ?? '') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                            @endforeach
                        </select>
                        <div class="form-text">Wajib dipilih jika role adalah Company.</div>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(function() {
    $('#roleSelect').change(function() {
        if ($(this).val() === 'company') {
            $('#companySelectDiv').slideDown();
            $('select[name="company_id"]').prop('required', true);
        } else {
            $('#companySelectDiv').slideUp();
            $('select[name="company_id"]').prop('required', false).val('').trigger('change');
        }
    });
});
</script>
@endpush
