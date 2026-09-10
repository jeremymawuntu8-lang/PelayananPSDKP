<?php $__env->startSection('title', 'Data Kapal'); ?>
<?php $__env->startSection('page-title', 'Data Kapal'); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item active">Data Kapal</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('actions'); ?>
<a href="<?php echo e(route('ships.create')); ?>" class="btn btn-primary">
    <i class="fas fa-plus me-1"></i>Tambah Kapal
</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
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
                    <?php $__currentLoopData = $ships; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($i + 1); ?></td>
                        <td class="fw-semibold text-primary"><?php echo e($s->name); ?></td>
                        <td><?php echo e($s->company->name ?? '-'); ?></td>
                        <td><?php echo e($s->fishing_gear ?? '-'); ?></td>
                        <td><?php echo e($s->home_port ?? '-'); ?></td>
                        <td><?php echo e($s->pelabuhan_keluar_terakhir ?? '-'); ?></td>
                        <td class="text-center text-nowrap">
                            <a href="<?php echo e(route('ships.edit', $s)); ?>" class="btn btn-xs btn-outline-warning" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form id="deleteForm<?php echo e($s->id); ?>" action="<?php echo e(route('ships.destroy', $s)); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="button" class="btn btn-xs btn-outline-danger" onclick="confirmDelete('deleteForm<?php echo e($s->id); ?>')" title="Hapus">
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
    $('#shipsTable').DataTable({
        columnDefs: [{ orderable: false, targets: -1 }]
    });
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\pelayanan psdkp\resources\views/ships/index.blade.php ENDPATH**/ ?>