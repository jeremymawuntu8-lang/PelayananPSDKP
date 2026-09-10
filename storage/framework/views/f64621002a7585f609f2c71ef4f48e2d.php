<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Dashboard'); ?> — <?php echo e(config('app.name', 'PSDKP Pelayanan')); ?></title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body style="background: var(--psdkp-bg);">

    
    <nav class="company-nav">
        <div class="brand d-flex align-items-center">
            <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Logo" style="height: 32px;" class="me-2">
            PSDKP <span class="ms-1">Pelayanan</span>
        </div>
        <div class="d-flex align-items-center gap-3">
            <div class="d-none d-md-block text-end">
                <div class="fw-semibold" style="font-size: 0.84rem;"><?php echo e(auth()->user()->name ?? ''); ?></div>
                <div class="text-muted" style="font-size: 0.72rem;">Pemilik Kapal</div>
            </div>
            <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode(auth()->user()->name ?? 'U')); ?>&background=0A5C6B&color=fff&size=36"
                 class="rounded-circle" width="36" height="36" alt="">
            <form method="POST" action="<?php echo e(route('logout')); ?>" class="d-inline">
                <?php echo csrf_field(); ?>
                <button class="btn btn-sm btn-outline-secondary" type="submit">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </form>
        </div>
    </nav>

    
    <div class="company-content">
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i><?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i><?php echo e(session('error')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        <?php if($errors->any()): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>
    </div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\pelayanan psdkp\resources\views/layouts/company.blade.php ENDPATH**/ ?>