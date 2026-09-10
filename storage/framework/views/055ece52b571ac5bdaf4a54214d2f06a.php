<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Pemilik Kapal | PSDKP Pelayanan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --ppsdk-primary: #0A3D6B;
            --ppsdk-primary-hover: #072a4a;
        }
        body { 
            background: #f8fafc;
            min-height: 100vh; 
            display: flex; 
            align-items: center; 
            font-family: 'Inter', sans-serif;
            margin: 0;
        }
        .login-card { 
            border: none; 
            border-radius: 20px; 
            box-shadow: 0 20px 40px rgba(0,0,0,0.08); 
            overflow: hidden; 
            background: #fff;
        }
        .login-side { 
            background: linear-gradient(135deg, var(--ppsdk-primary) 0%, #1565C0 100%); 
            color: #fff; 
            padding: 4rem 3rem; 
            display: flex; 
            flex-direction: column; 
            justify-content: center; 
            position: relative;
        }
        .login-side::before {
            content: "";
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: url('data:image/svg+xml;utf8,<svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="circles" width="40" height="40" patternUnits="userSpaceOnUse"><circle cx="20" cy="20" r="1.5" fill="rgba(255,255,255,0.05)"/></pattern></defs><rect width="100%" height="100%" fill="url(%23circles)"/></svg>');
            pointer-events: none;
        }
        .login-side-content { position: relative; z-index: 1; }
        
        .fade-in { animation: fadeIn 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

        /* Mobile Adjustments */
        @media (max-width: 768px) {
            body { padding: 1rem; }
            .login-card { border-radius: 16px; }
            .mobile-logo { display: block !important; text-align: center; margin-bottom: 1.5rem; }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-9 col-lg-10">
            <div class="card login-card fade-in">
                <div class="row g-0">
                    
                    <div class="col-md-5 login-side d-none d-md-flex text-center">
                        <div class="login-side-content">
                            <div class="mb-4">
                                <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Logo PSDKP" class="img-fluid" style="max-height: 130px; filter: drop-shadow(0 4px 8px rgba(0,0,0,0.3));">
                            </div>
                            <h3 class="fw-bold mb-3" style="letter-spacing: -0.02em;">PSDKP Pelayanan</h3>
                            <p class="mb-0 opacity-75 text-sm" style="line-height: 1.6;">Sistem Informasi Pelayanan Pengawasan Sumber Daya Kelautan dan Perikanan.</p>
                        </div>
                    </div>
                    
                    
                    <div class="col-md-7 p-4 p-md-5 p-xl-5 d-flex flex-column justify-content-center">
                        
                        
                        <div class="mobile-logo d-none">
                            <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Logo" style="height: 60px;">
                            <h4 class="fw-bold mt-2 mb-0" style="color: var(--ppsdk-primary);">PSDKP Pelayanan</h4>
                        </div>

                        <div class="mb-4 text-center text-md-start">
                            <h4 class="fw-bold mb-1" style="color: var(--ppsdk-primary);">Halo, Pemilik Kapal! 🚢</h4>
                            <p class="text-muted">Silakan masuk menggunakan akun Google Perusahaan Anda untuk mengakses dashboard pelayanan.</p>
                        </div>

                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger bg-danger-soft text-danger border-0 d-flex align-items-center" style="border-radius: 8px;">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <div>
                                    <ul class="mb-0 ps-3">
                                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><?php echo e($error); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="mt-2 mb-5">
                            <a href="<?php echo e(route('google.redirect')); ?>" class="btn w-100 fw-bold d-flex align-items-center justify-content-center gap-3" style="border: 2px solid #e2e8f0; border-radius: 12px; padding: 1rem; background: #fff; color: #475569; transition: all 0.2s; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" alt="Google" style="width: 24px; height: 24px;">
                                <span style="font-size: 1.1rem;">Lanjutkan dengan Google</span>
                            </a>
                        </div>
                        
                        <div class="text-center">
                            <a href="<?php echo e(route('login')); ?>" class="text-muted small text-decoration-none hover-primary">
                                <i class="fas fa-shield-alt me-1"></i> Login sebagai Admin / Petugas
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\pelayanan psdkp\resources\views/auth/login_company.blade.php ENDPATH**/ ?>