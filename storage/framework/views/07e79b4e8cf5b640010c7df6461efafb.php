<!doctype html>
<html lang="id" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Dashboard'); ?> — <?php echo e(config('app.name', 'PSDKP Pelayanan')); ?></title>

    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-beta3/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>?v=<?php echo e(filemtime(public_path('css/app.css'))); ?>">

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="layout-fixed sidebar-expand-lg">
<div class="app-wrapper">

    
    <nav class="app-header navbar navbar-expand-lg">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto d-flex align-items-center gap-2">
                <li class="nav-item">
                    <button class="theme-toggle" id="themeToggle" title="Ganti Tema">
                        <i class="fas fa-moon"></i>
                    </button>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" data-bs-toggle="dropdown">
                        <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode(auth()->user()->name ?? 'U')); ?>&background=0A5C6B&color=fff&size=32"
                             class="rounded-circle" width="32" height="32" alt="">
                        <span class="d-none d-md-inline fw-semibold" style="font-size: 0.84rem;"><?php echo e(auth()->user()->name ?? ''); ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><span class="dropdown-item-text text-muted" style="font-size: 0.78rem;"><?php echo e(auth()->user()->email ?? ''); ?></span></li>
                        <li><span class="dropdown-item-text"><span class="badge bg-primary"><?php echo e(strtoupper(auth()->user()->role ?? '')); ?></span></span></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="<?php echo e(route('logout')); ?>">
                                <?php echo csrf_field(); ?>
                                <button class="dropdown-item text-danger" type="submit">
                                    <i class="fas fa-sign-out-alt me-2"></i>Keluar
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    
    <aside class="app-sidebar shadow-lg" data-bs-theme="dark">
        <div class="sidebar-brand">
            <a href="<?php echo e(route('dashboard')); ?>" class="brand-link d-flex align-items-center text-decoration-none">
                <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Logo" class="brand-image me-2">
                <span class="brand-text text-white text-nowrap">
                    <strong>PSDKP</strong> <span style="font-size: 0.9em; opacity: 0.9;">Pelayanan</span>
                </span>
            </a>
        </div>

        <div class="sidebar-wrapper">
            <nav class="mt-2">
                <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu">

                    
                    <li class="nav-item">
                        <a href="<?php echo e(route('dashboard')); ?>" class="nav-link <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    
                    <li class="nav-item">
                        <a href="<?php echo e(route('jadwal.index')); ?>" class="nav-link <?php echo e(request()->routeIs('jadwal.*') ? 'active' : ''); ?>">
                            <i class="nav-icon fas fa-calendar-check"></i>
                            <p>Jadwal</p>
                        </a>
                    </li>

                    <?php if(auth()->user()->isStaff()): ?>

                    
                    <li class="nav-header">PELAYANAN</li>

                    <li class="nav-item <?php echo e(request()->routeIs('services.*') ? 'menu-open' : ''); ?>">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-clipboard-list"></i>
                            <p>Pelayanan <i class="nav-arrow fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo e(route('services.index')); ?>" class="nav-link <?php echo e(request()->routeIs('services.index') ? 'active' : ''); ?>">
                                    <i class="fas fa-list nav-icon"></i>
                                    <p>Daftar Pelayanan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('services.create')); ?>" class="nav-link <?php echo e(request()->routeIs('services.create') ? 'active' : ''); ?>">
                                    <i class="fas fa-plus-circle nav-icon"></i>
                                    <p>Input Pelayanan</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    
                    <li class="nav-header">MASTER DATA</li>

                    <li class="nav-item">
                        <a href="<?php echo e(route('companies.index')); ?>" class="nav-link <?php echo e(request()->routeIs('companies.*') ? 'active' : ''); ?>">
                            <i class="nav-icon fas fa-building"></i>
                            <p>Pemilik Kapal</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="<?php echo e(route('ships.index')); ?>" class="nav-link <?php echo e(request()->routeIs('ships.*') ? 'active' : ''); ?>">
                            <i class="nav-icon fas fa-ship"></i>
                            <p>Data Kapal</p>
                        </a>
                    </li>

                    <?php if(auth()->user()->role === 'admin'): ?>
                    
                    <li class="nav-header">ADMINISTRASI</li>

                    <li class="nav-item">
                        <a href="<?php echo e(route('users.index')); ?>" class="nav-link <?php echo e(request()->routeIs('users.*') ? 'active' : ''); ?>">
                            <i class="nav-icon fas fa-users-gear"></i>
                            <p>Manajemen User</p>
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php else: ?>
                    
                    <li class="nav-header">PEMILIK KAPAL</li>

                    <li class="nav-item">
                        <a href="<?php echo e(route('dashboard')); ?>" class="nav-link <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>">
                            <i class="nav-icon fas fa-folder-open"></i>
                            <p>Pelayanan Saya</p>
                        </a>
                    </li>
                    <?php endif; ?>

                </ul>
            </nav>
        </div>

        
        <div class="sidebar-user-panel d-flex align-items-center">
            <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode(auth()->user()->name ?? 'U')); ?>&background=0E8A9E&color=fff&size=36"
                 class="rounded-circle me-2" style="width: 32px; height: 32px; object-fit: cover;" alt="">
            <div class="flex-grow-1 overflow-hidden">
                <div class="text-white fw-semibold text-truncate" style="font-size: 0.82rem;"><?php echo e(auth()->user()->name ?? ''); ?></div>
                <div class="text-white-50" style="font-size: 0.72rem;"><?php echo e(ucfirst(auth()->user()->role ?? 'User')); ?></div>
            </div>
        </div>
    </aside>

    
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0"><?php echo $__env->yieldContent('page-title', 'Dashboard'); ?></h3>
                        <nav class="d-none d-md-block mt-1">
                            <ol class="breadcrumb mb-0" style="font-size: 0.78rem;">
                                <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>">Home</a></li>
                                <?php echo $__env->yieldContent('breadcrumb'); ?>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-auto">
                        <?php echo $__env->yieldContent('actions'); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content fade-in">
            <div class="container-fluid">
                <?php if(session('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert" id="alertSuccess">
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
                <?php if($errors->any() && !request()->routeIs('login')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Terdapat kesalahan:</strong>
                        <ul class="mb-0 mt-1">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>
    </main>

</div>

<?php echo $__env->yieldPushContent('modals'); ?>


<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-beta3/dist/js/adminlte.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // CSRF Setup
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

    // Select2 Init
    $('.select2').select2({ theme: 'bootstrap-5', width: '100%', placeholder: function(){ return $(this).data('placeholder') || '-- Pilih --'; } });

    // Auto-dismiss alerts after 5 seconds
    setTimeout(function() { $('#alertSuccess').alert('close'); }, 5000);

    // Global delete confirmation
    function confirmDelete(formId) {
        Swal.fire({
            title: 'Hapus data ini?',
            text: 'Data yang dihapus tidak dapat dikembalikan.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#C62828',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="fas fa-trash me-1"></i> Ya, hapus',
            cancelButtonText: 'Batal',
            customClass: { popup: 'rounded-xl' }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(formId).submit();
            }
        });
    }

    // Submit button loading state
    $(document).on('submit', 'form:not(.no-loading)', function() {
        const btn = $(this).find('button[type="submit"]');
        if (!btn.hasClass('btn-loading')) {
            btn.addClass('btn-loading').prop('disabled', true);
        }
    });

    // DataTable defaults
    $.extend(true, $.fn.dataTable.defaults, {
        responsive: true,
        language: {
            processing: '<div class="d-flex align-items-center gap-2"><div class="loading-spinner"></div> Memuat...</div>',
            emptyTable: '<div class="empty-state py-3"><i class="fas fa-inbox empty-state-icon"></i><div class="empty-state-title">Belum ada data</div><div class="empty-state-text">Data akan muncul setelah ditambahkan.</div></div>',
            zeroRecords: '<div class="empty-state py-3"><i class="fas fa-search empty-state-icon"></i><div class="empty-state-title">Tidak ditemukan</div><div class="empty-state-text">Data yang Anda cari tidak ditemukan.</div></div>',
            info: 'Menampilkan _START_-_END_ dari _TOTAL_ data',
            infoEmpty: 'Tidak ada data',
            infoFiltered: '(difilter dari _MAX_ total)',
            lengthMenu: 'Tampilkan _MENU_',
            search: '',
            searchPlaceholder: 'Cari...',
            paginate: { first: '«', previous: '‹', next: '›', last: '»' }
        },
        dom: "<'row mb-3'<'col-sm-6 col-12 mb-2 mb-sm-0'l><'col-sm-6 col-12'f>>" +
             "<'table-responsive'tr>" +
             "<'row mt-3'<'col-sm-5 col-12 mb-2 mb-sm-0 text-sm'i><'col-sm-7 col-12 d-flex justify-content-center justify-content-sm-end'p>>"
    });
</script>
<?php echo $__env->yieldPushContent('scripts'); ?>

<script>
// Dark Mode Toggle
(function() {
    const html = document.documentElement;
    const toggle = document.getElementById('themeToggle');
    const saved = localStorage.getItem('psdkp-theme') || 'light';
    
    html.setAttribute('data-bs-theme', saved);
    updateIcon(saved);

    toggle?.addEventListener('click', function() {
        const current = html.getAttribute('data-bs-theme');
        const next = current === 'dark' ? 'light' : 'dark';
        html.setAttribute('data-bs-theme', next);
        localStorage.setItem('psdkp-theme', next);
        updateIcon(next);
    });

    function updateIcon(theme) {
        if (!toggle) return;
        toggle.innerHTML = theme === 'dark'
            ? '<i class="fas fa-sun"></i>'
            : '<i class="fas fa-moon"></i>';
    }
})();
</script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\pelayanan psdkp\resources\views/layouts/app.blade.php ENDPATH**/ ?>