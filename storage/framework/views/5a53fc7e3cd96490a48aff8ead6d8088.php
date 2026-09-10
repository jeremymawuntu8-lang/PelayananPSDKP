<?php $__env->startSection('title', 'Input Pelayanan'); ?>
<?php $__env->startSection('page-title', 'Input Pelayanan'); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('services.index')); ?>">Pelayanan</a></li>
<li class="breadcrumb-item active">Input Baru</li>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .section-card {
        border-radius: 8px;
        border: 1px solid #e0e0e0;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        margin-bottom: 1.5rem;
        overflow: hidden;
    }
    .section-header {
        background-color: #0A3D6B !important;
        color: #ffffff;
        padding: 0.8rem 1.25rem;
        font-weight: 600;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .section-body {
        padding: 1.5rem;
        background-color: #ffffff;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<form method="POST" action="<?php echo e(route('services.store')); ?>" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    
    <div class="row g-3">
        <div class="col-12">

            
            <div class="section-card">
                <div class="section-header">
                    <span>Objek Pelaporan</span>
                    <div><i class="fas fa-expand me-2" style="cursor:pointer;"></i> <i class="fas fa-minus" style="cursor:pointer;"></i></div>
                </div>
                <div class="section-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Pemilik Kapal / Company <span class="text-danger">*</span></label>
                            <input type="text" name="company_name" class="form-control" list="company_list" value="<?php echo e(old('company_name')); ?>" placeholder="Ketik nama pemilik..." required>
                            <datalist id="company_list">
                                <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($c->name); ?>">
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </datalist>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">No. WhatsApp Pemilik <span class="text-danger">*</span></label>
                            <input type="text" name="company_phone" class="form-control" value="<?php echo e(old('company_phone')); ?>" placeholder="Contoh: 08123456789" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Nama Kapal</label>
                            <input type="text" name="ship_name" class="form-control" list="ship_list" value="<?php echo e(old('ship_name')); ?>" placeholder="Ketik nama kapal...">
                            <datalist id="ship_list">
                                <?php $__currentLoopData = $ships; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($s->name); ?>">
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </datalist>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">No Transmitter</label>
                            <input type="text" name="transmitter_no" class="form-control" value="<?php echo e(old('transmitter_no')); ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">No Buku Kapal</label>
                            <input type="text" name="book_no" class="form-control" value="<?php echo e(old('book_no')); ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Jenis Alat Tangkap</label>
                            <input type="text" name="fishing_gear" class="form-control" value="<?php echo e(old('fishing_gear')); ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Ukuran (GT)</label>
                            <input type="text" name="size" class="form-control" value="<?php echo e(old('size')); ?>">
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="section-card">
                <div class="section-header">
                    <span>Analysis</span>
                    <div><i class="fas fa-expand me-2" style="cursor:pointer;"></i> <i class="fas fa-minus" style="cursor:pointer;"></i></div>
                </div>
                <div class="section-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Lembar Indikasi</label>
                            <input type="text" name="lembar_indikasi" class="form-control" value="<?php echo e(old('lembar_indikasi')); ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Indikasi</label>
                            <input type="text" name="indikasi" class="form-control" value="<?php echo e(old('indikasi')); ?>">
                        </div>
                        <div class="col-12">
                            <label class="form-label">ANALYSIS (Deskripsi)</label>
                            <textarea name="analysis" class="form-control" rows="3"><?php echo e(old('analysis')); ?></textarea>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Analyst</label>
                            <input type="text" name="analyst" class="form-control" value="<?php echo e(old('analyst')); ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Verificator</label>
                            <input type="text" name="verificator" class="form-control" value="<?php echo e(old('verificator')); ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Unit Kerja</label>
                            <input type="text" name="unit_kerja" class="form-control" value="<?php echo e(old('unit_kerja')); ?>">
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="section-card">
                <div class="section-header">
                    <span>Perizinan</span>
                    <div><i class="fas fa-expand me-2" style="cursor:pointer;"></i> <i class="fas fa-minus" style="cursor:pointer;"></i></div>
                </div>
                <div class="section-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">No SIPI</label>
                            <input type="text" name="sipi_no" class="form-control" value="<?php echo e(old('sipi_no')); ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Periode SIPI (Mulai)</label>
                            <input type="date" name="sipi_start" class="form-control" value="<?php echo e(old('sipi_start')); ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Periode SIPI (Selesai)</label>
                            <input type="date" name="sipi_end" class="form-control" value="<?php echo e(old('sipi_end')); ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">DPI</label>
                            <input type="text" name="dpi" class="form-control" value="<?php echo e(old('dpi')); ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Pelabuhan Pangkalan</label>
                            <input type="text" name="home_port" class="form-control" value="<?php echo e(old('home_port')); ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Penerbit SLO</label>
                            <input type="text" name="slo_issuer" class="form-control" value="<?php echo e(old('slo_issuer')); ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Jenis Izin</label>
                            <input type="text" name="license_type" class="form-control" value="<?php echo e(old('license_type')); ?>">
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="section-card">
                <div class="section-header">
                    <span>Ditemukan Indikasi Pelanggaran</span>
                    <div><i class="fas fa-expand me-2" style="cursor:pointer;"></i> <i class="fas fa-minus" style="cursor:pointer;"></i></div>
                </div>
                <div class="section-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Indikasi Pelanggaran</label>
                            <input type="text" name="indikasi_pelanggaran" class="form-control" value="<?php echo e(old('indikasi_pelanggaran')); ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Duga Langgar (Opsional)</label>
                            <input type="text" name="duga_langgar" class="form-control" value="<?php echo e(old('duga_langgar')); ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Period Violation (Mulai)</label>
                            <input type="date" name="period_violation_start" class="form-control" value="<?php echo e(old('period_violation_start')); ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Period Violation (Selesai)</label>
                            <input type="date" name="period_violation_end" class="form-control" value="<?php echo e(old('period_violation_end')); ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Pelabuhan Keluar Terakhir</label>
                            <input type="text" name="pelabuhan_keluar_terakhir" class="form-control" value="<?php echo e(old('pelabuhan_keluar_terakhir')); ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Mulai Melanggar</label>
                            <input type="date" name="mulai_melanggar" class="form-control" value="<?php echo e(old('mulai_melanggar')); ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Frekuensi Pelanggaran</label>
                            <input type="number" name="frekuensi_pelanggaran" class="form-control" value="<?php echo e(old('frekuensi_pelanggaran')); ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">UPT Terdekat Posisi Kapal</label>
                            <input type="text" name="upt_terdekat" class="form-control" value="<?php echo e(old('upt_terdekat')); ?>">
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="section-card">
                <div class="section-header">
                    <span>Surat Analisis DIR POA & Dokumen</span>
                    <div><i class="fas fa-expand me-2" style="cursor:pointer;"></i> <i class="fas fa-minus" style="cursor:pointer;"></i></div>
                </div>
                <div class="section-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Nomor Surat Analisis</label>
                            <input type="text" name="surat_analisis_nomor" class="form-control" value="<?php echo e(old('surat_analisis_nomor')); ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">SKAT Nomor</label>
                            <input type="text" name="skat_nomor" class="form-control" value="<?php echo e(old('skat_nomor')); ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Masa Berlaku</label>
                            <input type="date" name="masa_berlaku" class="form-control" value="<?php echo e(old('masa_berlaku')); ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Titik Lokasi (Latitude)</label>
                            <input type="text" name="latitude" class="form-control" value="<?php echo e(old('latitude')); ?>" placeholder="Contoh: -6.1751">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Titik Lokasi (Longitude)</label>
                            <input type="text" name="longitude" class="form-control" value="<?php echo e(old('longitude')); ?>" placeholder="Contoh: 106.8272">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tipe Dokumen</label>
                            <select name="doc_type" class="form-select">
                                <option value="">-- Pilih Tipe --</option>
                                <option>Surat Analisis DIR POA</option>
                                <option>SKAT</option>
                                <option>Lembar Indikasi</option>
                                <option>Surat Tugas</option>
                                <option>Lainnya</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Nomor Surat Lampiran</label>
                            <input type="text" name="nomor_surat" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">File</label>
                            <input type="file" name="document" class="form-control">
                            <div class="form-text">PDF, JPG, PNG (maks. 10MB)</div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary px-5 py-3 fs-5 fw-bold w-100 shadow-sm mt-3 mb-5" style="background-color: #0A3D6B; border: none;">
                <i class="fas fa-save me-2"></i>Simpan & Buat Link Pelayanan
            </button>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\pelayanan psdkp\resources\views/services/create.blade.php ENDPATH**/ ?>