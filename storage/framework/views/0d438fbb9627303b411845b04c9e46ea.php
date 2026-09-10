<?php $__env->startSection('title', isset($ship) ? 'Edit Kapal' : 'Tambah Kapal'); ?>
<?php $__env->startSection('page-title', isset($ship) ? 'Edit Kapal' : 'Tambah Kapal'); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('ships.index')); ?>">Data Kapal</a></li>
<li class="breadcrumb-item active"><?php echo e(isset($ship) ? 'Edit' : 'Tambah'); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-10 mx-auto">
        <form action="<?php echo e(isset($ship) ? route('ships.update', $ship) : route('ships.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php if(isset($ship)): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>
            
            <div class="card mb-4">
                <div class="card-header bg-white"><i class="fas fa-ship me-2 text-primary"></i>Data Utama Kapal</div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Pemilik Kapal <span class="text-danger">*</span></label>
                            <select name="company_id" class="form-select select2" required>
                                <option value="">Pilih Pemilik Kapal</option>
                                <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($c->id); ?>" <?php echo e(old('company_id', $ship->company_id ?? '') == $c->id ? 'selected' : ''); ?>><?php echo e($c->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nama Kapal <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" value="<?php echo e(old('name', $ship->name ?? '')); ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">No. Transmitter</label>
                            <input type="text" name="transmitter_no" class="form-control" value="<?php echo e(old('transmitter_no', $ship->transmitter_no ?? '')); ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Buku Kapal</label>
                            <input type="text" name="book_no" class="form-control" value="<?php echo e(old('book_no', $ship->book_no ?? '')); ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Alat Tangkap (Fishing Gear)</label>
                            <input type="text" name="fishing_gear" class="form-control" value="<?php echo e(old('fishing_gear', $ship->fishing_gear ?? '')); ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Ukuran (Size)</label>
                            <input type="text" name="size" class="form-control" value="<?php echo e(old('size', $ship->size ?? '')); ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Pelabuhan Pangkal</label>
                            <input type="text" name="home_port" class="form-control" value="<?php echo e(old('home_port', $ship->home_port ?? '')); ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Pelabuhan Keluar Terakhir</label>
                            <input type="text" name="pelabuhan_keluar_terakhir" class="form-control" value="<?php echo e(old('pelabuhan_keluar_terakhir', $ship->pelabuhan_keluar_terakhir ?? '')); ?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-white"><i class="fas fa-file-contract me-2 text-primary"></i>Data Perizinan (SIPI/SIKPI)</div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">No. SIPI</label>
                            <input type="text" name="sipi_no" class="form-control" value="<?php echo e(old('sipi_no', $ship->sipi_no ?? '')); ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">DPI (Daerah Penangkapan)</label>
                            <input type="text" name="dpi" class="form-control" value="<?php echo e(old('dpi', $ship->dpi ?? '')); ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Masa Berlaku SIPI (Mulai)</label>
                            <input type="date" name="sipi_start" class="form-control" value="<?php echo e(old('sipi_start', isset($ship->sipi_start) ? $ship->sipi_start->format('Y-m-d') : '')); ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Masa Berlaku SIPI (Selesai)</label>
                            <input type="date" name="sipi_end" class="form-control" value="<?php echo e(old('sipi_end', isset($ship->sipi_end) ? $ship->sipi_end->format('Y-m-d') : '')); ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Penerbit SLO</label>
                            <input type="text" name="slo_issuer" class="form-control" value="<?php echo e(old('slo_issuer', $ship->slo_issuer ?? '')); ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jenis Izin</label>
                            <input type="text" name="license_type" class="form-control" value="<?php echo e(old('license_type', $ship->license_type ?? '')); ?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="<?php echo e(route('ships.index')); ?>" class="btn btn-outline-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>Simpan Data Kapal
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\pelayanan psdkp\resources\views/ships/form.blade.php ENDPATH**/ ?>