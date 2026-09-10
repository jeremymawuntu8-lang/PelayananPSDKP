<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cari Dokumen Pelayanan | PSDKP</title>
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
                            <div class="d-inline-flex align-items-center justify-content-center bg-warning bg-opacity-10 text-warning rounded-circle mb-3" style="width: 60px; height: 60px;">
                                <i class="fas fa-search fs-3"></i>
                            </div>
                            <h4 class="fw-bold mb-2" style="color: var(--ppsdk-primary);">Cari Dokumen Kapal</h4>
                            <p class="text-muted">Masukkan <strong>Kode Unik</strong> atau <strong>PIN</strong> yang Anda terima via WhatsApp untuk menemukan dokumen pelayanan Anda.</p>
                        </div>

                        <?php if(session('error')): ?>
                            <div class="alert alert-danger bg-danger-soft text-danger border-0 d-flex align-items-center mb-4" style="border-radius: 8px;">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <div><?php echo e(session('error')); ?></div>
                            </div>
                        <?php endif; ?>

                        <form action="<?php echo e(route('klaim.submit')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="mb-4">
                                <label class="form-label fw-bold text-muted small text-uppercase">Kode Unik / PIN</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-light border-end-0 text-muted">
                                        <i class="fas fa-key"></i>
                                    </span>
                                    <input type="text" name="unique_code" class="form-control border-start-0 bg-light" placeholder="Contoh: 110987" required autocomplete="off" style="font-weight: 500; letter-spacing: 2px;">
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold shadow-sm" style="background-color: var(--ppsdk-primary); border-radius: 10px;">
                                <i class="fas fa-arrow-right me-2"></i> Lanjutkan
                            </button>
                        </form>
                        
                        <div class="text-center mt-5">
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
<?php /**PATH C:\xampp\htdocs\pelayanan psdkp\resources\views/auth/claim_code.blade.php ENDPATH**/ ?>