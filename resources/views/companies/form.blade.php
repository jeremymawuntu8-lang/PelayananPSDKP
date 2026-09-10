@extends('layouts.app')
@section('title', isset($company) ? 'Edit Pemilik Kapal' : 'Tambah Pemilik Kapal')
@section('page-title', isset($company) ? 'Edit Pemilik Kapal' : 'Tambah Pemilik Kapal')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('companies.index') }}">Pemilik Kapal</a></li>
<li class="breadcrumb-item active">{{ isset($company) ? 'Edit' : 'Tambah' }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-body">
                <form action="{{ isset($company) ? route('companies.update', $company) : route('companies.store') }}" method="POST">
                    @csrf
                    @if(isset($company)) @method('PUT') @endif
                    
                    <div class="mb-3">
                        <label class="form-label">Nama Perusahaan / Pemilik <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $company->name ?? '') }}" required autofocus>
                    </div>
                    
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $company->email ?? '') }}" placeholder="email@contoh.com">
                            <div class="form-text">Digunakan untuk akses login (Company)</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nomor HP / WhatsApp</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone', $company->phone ?? '') }}" placeholder="08xxxxxxxxxx">
                            <div class="form-text">Untuk mengirim notifikasi/link via WA</div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label">Alamat</label>
                        <textarea name="address" class="form-control" rows="3">{{ old('address', $company->address ?? '') }}</textarea>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('companies.index') }}" class="btn btn-outline-secondary">Batal</a>
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
