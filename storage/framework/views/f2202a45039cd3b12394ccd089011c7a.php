<?php $__env->startSection('title', isset($user) ? 'Edit User' : 'Tambah User'); ?>
<?php $__env->startSection('page-title', isset($user) ? 'Edit User' : 'Tambah User'); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('users.index')); ?>">Users</a></li>
<li class="breadcrumb-item active"><?php echo e(isset($user) ? 'Edit' : 'Tambah'); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-body">
                <form action="<?php echo e(isset($user) ? route('users.update', $user) : route('users.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php if(isset($user)): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>
                    
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="<?php echo e(old('name', $user->name ?? '')); ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" value="<?php echo e(old('email', $user->email ?? '')); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password <?php echo isset($user) ? '<small class="text-muted fw-normal">(Kosongkan jika tidak ingin diubah)</small>' : '<span class="text-danger">*</span>'; ?></label>
                        <input type="password" name="password" class="form-control" <?php echo e(isset($user) ? '' : 'required'); ?>>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Role <span class="text-danger">*</span></label>
                        <select name="role" class="form-select" id="roleSelect" required>
                            <option value="petugas" <?php echo e(old('role', $user->role ?? '') == 'petugas' ? 'selected' : ''); ?>>Petugas</option>
                            <option value="admin" <?php echo e(old('role', $user->role ?? '') == 'admin' ? 'selected' : ''); ?>>Admin</option>
                            <option value="company" <?php echo e(old('role', $user->role ?? '') == 'company' ? 'selected' : ''); ?>>Company / Pemilik Kapal</option>
                        </select>
                    </div>

                    <div class="mb-4" id="companySelectDiv" style="<?php echo e(old('role', $user->role ?? '') == 'company' ? '' : 'display:none;'); ?>">
                        <label class="form-label">Pilih Perusahaan <span class="text-danger">*</span></label>
                        <select name="company_id" class="form-select select2">
                            <option value="">-- Pilih Perusahaan --</option>
                            <?php $__currentLoopData = \App\Models\Company::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($c->id); ?>" <?php echo e(old('company_id', $user->company_id ?? '') == $c->id ? 'selected' : ''); ?>><?php echo e($c->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <div class="form-text">Wajib dipilih jika role adalah Company.</div>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="<?php echo e(route('users.index')); ?>" class="btn btn-outline-secondary">Batal</a>
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

<?php $__env->startPush('scripts'); ?>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\pelayanan psdkp\resources\views/admin/users/form.blade.php ENDPATH**/ ?>