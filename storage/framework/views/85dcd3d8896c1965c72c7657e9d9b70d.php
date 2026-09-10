<?php $__env->startSection('title', isset($company) ? 'Edit Pemilik Kapal' : 'Tambah Pemilik Kapal'); ?>
<?php $__env->startSection('page-title', isset($company) ? 'Edit Pemilik Kapal' : 'Tambah Pemilik Kapal'); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('companies.index')); ?>">Pemilik Kapal</a></li>
<li class="breadcrumb-item active"><?php echo e(isset($company) ? 'Edit' : 'Tambah'); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-body">
                <form action="<?php echo e(isset($company) ? route('companies.update', $company) : route('companies.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php if(isset($company)): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>
                    
                    <div class="mb-3">
                        <label class="form-label">Nama Perusahaan / Pemilik <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="<?php echo e(old('name', $company->name ?? '')); ?>" required autofocus>
                    </div>
                    
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="<?php echo e(old('email', $company->email ?? '')); ?>" placeholder="email@contoh.com">
                            <div class="form-text">Digunakan untuk akses login (Company)</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nomor HP / WhatsApp</label>
                            <input type="text" name="phone" class="form-control" value="<?php echo e(old('phone', $company->phone ?? '')); ?>" placeholder="08xxxxxxxxxx">
                            <div class="form-text">Untuk mengirim notifikasi/link via WA</div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label">Alamat</label>
                        <textarea name="address" class="form-control" rows="3"><?php echo e(old('address', $company->address ?? '')); ?></textarea>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="<?php echo e(route('companies.index')); ?>" class="btn btn-outline-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\pelayanan psdkp\resources\views/companies/form.blade.php ENDPATH**/ ?>