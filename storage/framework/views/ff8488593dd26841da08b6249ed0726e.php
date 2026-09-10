<?php $__env->startSection('title', 'Manajemen User'); ?>
<?php $__env->startSection('page-title', 'Manajemen User'); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item active">Users</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('actions'); ?>
<a href="<?php echo e(route('users.create')); ?>" class="btn btn-primary">
    <i class="fas fa-user-plus me-1"></i>Tambah User
</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
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
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($i + 1); ?></td>
                        <td class="fw-semibold"><?php echo e($u->name); ?></td>
                        <td><?php echo e($u->email); ?></td>
                        <td>
                            <span class="badge <?php echo e($u->role == 'admin' ? 'bg-primary' : ($u->role == 'petugas' ? 'bg-info' : 'bg-secondary')); ?>">
                                <?php echo e(strtoupper($u->role)); ?>

                            </span>
                        </td>
                        <td><?php echo e($u->company->name ?? '-'); ?></td>
                        <td class="text-center text-nowrap">
                            <a href="<?php echo e(route('users.edit', $u)); ?>" class="btn btn-xs btn-outline-warning" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <?php if($u->id !== auth()->id()): ?>
                            <form id="deleteForm<?php echo e($u->id); ?>" action="<?php echo e(route('users.destroy', $u)); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="button" class="btn btn-xs btn-outline-danger" onclick="confirmDelete('deleteForm<?php echo e($u->id); ?>')" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            <?php endif; ?>
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
    $('#usersTable').DataTable({
        columnDefs: [{ orderable: false, targets: -1 }]
    });
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\pelayanan psdkp\resources\views/admin/users/index.blade.php ENDPATH**/ ?>