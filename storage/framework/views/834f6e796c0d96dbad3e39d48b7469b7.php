<?php $__env->startSection('title', 'Daftar Pelayanan'); ?>
<?php $__env->startSection('page-title', 'Daftar Pelayanan'); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item active">Pelayanan</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('actions'); ?>
<a href="<?php echo e(route('services.create')); ?>" class="btn btn-primary">
    <i class="fas fa-plus me-1"></i>Input Pelayanan
</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="servicesTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Kategori</th>
                        <th>Subjek / Pelaporan</th>
                        <th>Pemilik Kapal</th>
                        <th>Kapal</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($i + 1); ?></td>
                        <td class="text-nowrap"><?php echo e($s->created_at->format('d/m/Y')); ?></td>
                        <td><?php echo e($s->category); ?></td>
                        <td><?php echo e(Str::limit($s->subject, 50)); ?></td>
                        <td><?php echo e($s->company->name ?? '-'); ?></td>
                        <td><?php echo e($s->ship->name ?? '-'); ?></td>
                        <td>
                            <?php if($s->status == 'submitted'): ?>
                                <span class="badge text-bg-warning fw-bold shadow-sm" style="border: 1px solid #e0a800;">
                                    <i class="fas fa-bell text-danger me-1"></i>Menunggu Kedatangan
                                </span>
                            <?php else: ?>
                                <span class="badge <?php echo e($s->status == 'completed' ? 'text-bg-success' : 'text-bg-secondary'); ?>">
                                    <?php echo e(ucfirst(str_replace('_', ' ', $s->status))); ?>

                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center text-nowrap">
                            <a href="<?php echo e(route('services.show', $s)); ?>" class="btn btn-xs btn-outline-primary" title="Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <?php if($s->getWhatsappLink()): ?>
                            <a href="<?php echo e($s->getWhatsappLink()); ?>" target="_blank" class="btn btn-xs btn-whatsapp" title="Kirim via WhatsApp">
                                <i class="fab fa-whatsapp"></i>
                            </a>
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
    $('#servicesTable').DataTable({
        order: [[1, 'desc']],
        columnDefs: [{ orderable: false, targets: -1 }]
    });
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\pelayanan psdkp\resources\views/services/index.blade.php ENDPATH**/ ?>