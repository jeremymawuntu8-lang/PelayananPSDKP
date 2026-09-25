<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('page-title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>

<div class="row g-3 mb-4">
    <div class="col-xl-3 col-md-6 col-6">
        <div class="stat-card stat-card-blue fade-in">
            <i class="fas fa-building stat-icon"></i>
            <div>
                <div class="stat-value"><?php echo e($stats['companies']); ?></div>
                <div class="stat-label">Pemilik Kapal</div>
            </div>
            <div class="stat-footer">
                <a href="<?php echo e(route('companies.index') ?? '#'); ?>">Lihat detail <i class="fas fa-arrow-right ms-1"></i></a>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 col-6">
        <div class="stat-card stat-card-cyan fade-in">
            <i class="fas fa-ship stat-icon"></i>
            <div>
                <div class="stat-value"><?php echo e($stats['ships']); ?></div>
                <div class="stat-label">Data Kapal</div>
            </div>
            <div class="stat-footer">
                <a href="<?php echo e(route('ships.index') ?? '#'); ?>">Lihat detail <i class="fas fa-arrow-right ms-1"></i></a>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 col-6">
        <div class="stat-card stat-card-amber fade-in">
            <i class="fas fa-clipboard-list stat-icon"></i>
            <div>
                <div class="stat-value"><?php echo e($stats['total_services']); ?></div>
                <div class="stat-label">Total Pelayanan</div>
            </div>
            <div class="stat-footer">
                <a href="<?php echo e(route('services.index')); ?>">Lihat detail <i class="fas fa-arrow-right ms-1"></i></a>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 col-6">
        <div class="stat-card stat-card-green fade-in">
            <i class="fas fa-check-circle stat-icon"></i>
            <div>
                <div class="stat-value"><?php echo e($stats['completed']); ?></div>
                <div class="stat-label">Selesai</div>
            </div>
            <div class="stat-footer">
                <a href="<?php echo e(route('services.index')); ?>">Lihat detail <i class="fas fa-arrow-right ms-1"></i></a>
            </div>
        </div>
    </div>
</div>

<?php if($upcomingArrivals->count() > 0): ?>
<div class="card mb-4 border-warning shadow-sm" style="border-left: 5px solid #ffc107;">
    <div class="card-header bg-warning bg-opacity-10 text-dark fw-bold d-flex align-items-center justify-content-between">
        <span><i class="fas fa-bell text-warning me-2"></i>Jadwal Kedatangan Terdekat (Telah Dikonfirmasi)</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Tgl & Jam Kedatangan</th>
                        <th>Perusahaan / Kapal</th>
                        <th>Kehadiran</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $upcomingArrivals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $arr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <span class="badge bg-warning text-dark fw-bold mb-1">
                                <i class="fas fa-calendar-alt me-1"></i> <?php echo e($arr->arrival_date->format('d M Y')); ?>

                            </span><br>
                            <span class="text-muted fs-sm"><i class="fas fa-clock me-1"></i> Pukul <?php echo e($arr->arrival_time); ?></span>
                        </td>
                        <td>
                            <div class="fw-bold"><?php echo e($arr->company->name); ?></div>
                            <div class="fs-sm text-muted"><i class="fas fa-ship me-1"></i> <?php echo e($arr->ship->name ?? '-'); ?></div>
                        </td>
                        <td>
                            <?php $arrAttendances = explode(',', $arr->attendance_type); ?>
                            <?php if(in_array('pemilik', $arrAttendances)): ?>
                                <span class="badge bg-success bg-opacity-10 text-success"><i class="fas fa-user-tie me-1"></i> Pemilik</span>
                            <?php endif; ?>
                            <?php if(in_array('nahkoda', $arrAttendances)): ?>
                                <span class="badge" style="background: rgba(2, 119, 189, 0.1); color: #0277BD; border: 1px solid rgba(2, 119, 189, 0.2);"><i class="fas fa-ship me-1"></i> Nahkoda</span>
                            <?php endif; ?>
                            <?php if(in_array('diwakilkan', $arrAttendances)): ?>
                                <span class="badge bg-info bg-opacity-10 text-info"><i class="fas fa-users me-1"></i> Diwakilkan</span>
                                <div class="fs-sm mt-1 text-muted"><?php echo e($arr->attendance_notes); ?></div>
                            <?php endif; ?>
                        </td>
                        <td class="text-end align-middle">
                            <a href="<?php echo e(route('services.show', $arr->id)); ?>" class="btn btn-sm btn-primary">
                                <i class="fas fa-file-alt me-1"></i> Lihat Dokumen
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php endif; ?>


<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="fas fa-clock me-2 text-muted"></i>Pelayanan Terbaru</span>
        <a href="<?php echo e(route('services.index')); ?>" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Kategori</th>
                        <th>Subjek</th>
                        <th>Pemilik</th>
                        <th>Kapal</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="text-nowrap"><?php echo e($s->created_at->format('d/m/Y')); ?></td>
                        <td><?php echo e($s->category); ?></td>
                        <td><?php echo e(Str::limit($s->subject, 40)); ?></td>
                        <td><?php echo e($s->company->name ?? '-'); ?></td>
                        <td><?php echo e($s->ship->name ?? '-'); ?></td>
                        <td>
                            <span class="badge <?php echo e($s->status == 'completed' ? 'text-bg-success' : ($s->status == 'submitted' ? 'text-bg-warning' : 'text-bg-primary')); ?>">
                                <?php echo e(ucfirst(str_replace('_', ' ', $s->status))); ?>

                            </span>
                        </td>
                        <td>
                            <a href="<?php echo e(route('services.show', $s)); ?>" class="btn btn-xs btn-outline-primary">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">
                            <i class="fas fa-inbox d-block mb-2" style="font-size: 1.5rem;"></i>
                            Belum ada data pelayanan
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\pelayanan psdkp\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>