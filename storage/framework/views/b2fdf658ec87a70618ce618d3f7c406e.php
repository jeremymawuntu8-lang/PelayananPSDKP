<?php $__env->startSection('title', 'Pemilik Kapal'); ?>
<?php $__env->startSection('page-title', 'Data Pemilik Kapal'); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item active">Pemilik Kapal</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('actions'); ?>
<a href="<?php echo e(route('companies.create')); ?>" class="btn btn-primary">
    <i class="fas fa-plus me-1"></i>Tambah Pemilik Kapal
</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
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
                    <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($i + 1); ?></td>
                        <td class="fw-semibold text-primary"><?php echo e($c->name); ?></td>
                        <td><?php echo e($c->email ?? '-'); ?></td>
                        <td>
                            <?php if($c->phone): ?>
                            <a href="https://wa.me/<?php echo e(preg_replace('/[^0-9]/', '', $c->phone)); ?>" target="_blank" class="text-success text-decoration-none">
                                <i class="fab fa-whatsapp me-1"></i><?php echo e($c->phone); ?>

                            </a>
                            <?php else: ?>
                            -
                            <?php endif; ?>
                        </td>
                        <td>
                            <span class="badge bg-info-soft text-info"><?php echo e($c->ships->count()); ?> Kapal</span>
                        </td>
                        <td class="text-center text-nowrap">
                            <a href="<?php echo e(route('companies.edit', $c)); ?>" class="btn btn-xs btn-outline-warning" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form id="deleteForm<?php echo e($c->id); ?>" action="<?php echo e(route('companies.destroy', $c)); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="button" class="btn btn-xs btn-outline-danger" onclick="confirmDelete('deleteForm<?php echo e($c->id); ?>')" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
$(function() {
    $('#companiesTable').DataTable({
        columnDefs: [{ orderable: false, targets: -1 }]
    });
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\pelayanan psdkp\resources\views/companies/index.blade.php ENDPATH**/ ?>