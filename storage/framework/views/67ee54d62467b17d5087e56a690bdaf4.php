<?php $__env->startSection('title', 'Detail Pelayanan'); ?>
<?php $__env->startSection('page-title', 'Detail Pelayanan'); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('services.index')); ?>">Pelayanan</a></li>
<li class="breadcrumb-item active">Detail</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row g-3">
    
    <div class="col-lg-8">
        
        <div class="card mb-3 border-0 shadow-sm" style="border-top: 4px solid var(--psdkp-primary) !important;">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="badge <?php echo e($service->status == 'completed' ? 'text-bg-success' : ($service->status == 'submitted' ? 'text-bg-warning' : 'text-bg-primary')); ?> fs-6 px-3 py-2">
                        <?php echo e(ucfirst(str_replace('_', ' ', $service->status))); ?>

                    </span>
                    <?php if($service->getWhatsappLink()): ?>
                    <a href="<?php echo e($service->getWhatsappLink()); ?>" target="_blank" class="btn btn-whatsapp">
                        <i class="fab fa-whatsapp me-2"></i>Kirim Link via WA
                    </a>
                    <?php endif; ?>
                </div>
                <h4 class="fw-bold mt-3 mb-1"><?php echo e($service->subject); ?></h4>
                <p class="text-muted mb-0"><i class="fas fa-tag me-2"></i><?php echo e($service->category); ?> | <strong>Token:</strong> <?php echo e($service->token); ?></p>
            </div>
        </div>

        
        <div class="detail-section">
            <div class="detail-section-header">
                <i class="fas fa-ship"></i> 1. Objek Pelaporan
            </div>
            <div class="detail-section-body">
                <div class="detail-row">
                    <div class="detail-label">Pemilik Kapal</div>
                    <div class="detail-value fw-semibold"><?php echo e($service->company->name ?? '-'); ?></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Nama Kapal</div>
                    <div class="detail-value fw-semibold"><?php echo e($service->ship?->name ?? '-'); ?></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">No Transmitter</div>
                    <div class="detail-value"><?php echo e($service->ship?->transmitter_no ?? '-'); ?></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">No Buku Kapal</div>
                    <div class="detail-value"><?php echo e($service->ship?->book_no ?? '-'); ?></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Jenis Alat Tangkap</div>
                    <div class="detail-value"><?php echo e($service->ship?->fishing_gear ?? '-'); ?></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Ukuran (GT)</div>
                    <div class="detail-value"><?php echo e($service->ship?->size ?? '-'); ?></div>
                </div>
            </div>
        </div>

        
        <div class="detail-section">
            <div class="detail-section-header teal">
                <i class="fas fa-search"></i> 2. Analysis
            </div>
            <div class="detail-section-body">
                <div class="detail-row">
                    <div class="detail-label">Lembar Indikasi</div>
                    <div class="detail-value"><?php echo e($service->lembar_indikasi ?? '-'); ?></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Indikasi</div>
                    <div class="detail-value fw-semibold text-danger"><?php echo e($service->indikasi ?? '-'); ?></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">ANALYSIS (Deskripsi)</div>
                    <div class="detail-value pre-wrap"><?php echo e($service->analysis ?? '-'); ?></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Analyst</div>
                    <div class="detail-value"><?php echo e($service->analyst ?? '-'); ?></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Verificator</div>
                    <div class="detail-value"><?php echo e($service->verificator ?? '-'); ?></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Unit Kerja</div>
                    <div class="detail-value"><?php echo e($service->unit_kerja ?? '-'); ?></div>
                </div>
            </div>
        </div>

        
        <div class="detail-section">
            <div class="detail-section-header bg-success text-white">
                <i class="fas fa-file-signature"></i> 3. Perizinan
            </div>
            <div class="detail-section-body">
                <div class="detail-row">
                    <div class="detail-label">No SIPI</div>
                    <div class="detail-value"><?php echo e($service->ship?->sipi_no ?? '-'); ?></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Periode SIPI</div>
                    <div class="detail-value">
                        <?php echo e($service->ship?->sipi_start ? \Carbon\Carbon::parse($service->ship?->sipi_start)->format('d M Y') : '-'); ?> s.d 
                        <?php echo e($service->ship?->sipi_end ? \Carbon\Carbon::parse($service->ship?->sipi_end)->format('d M Y') : '-'); ?>

                    </div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">DPI</div>
                    <div class="detail-value"><?php echo e($service->ship?->dpi ?? '-'); ?></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Pelabuhan Pangkalan</div>
                    <div class="detail-value"><?php echo e($service->ship?->home_port ?? '-'); ?></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Penerbit SLO</div>
                    <div class="detail-value"><?php echo e($service->ship?->slo_issuer ?? '-'); ?></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Jenis Izin</div>
                    <div class="detail-value"><?php echo e($service->ship?->license_type ?? '-'); ?></div>
                </div>
            </div>
        </div>

        
        <div class="detail-section">
            <div class="detail-section-header orange">
                <i class="fas fa-exclamation-triangle"></i> 4. Ditemukan Indikasi Pelanggaran
            </div>
            <div class="detail-section-body">
                <div class="detail-row">
                    <div class="detail-label">Indikasi Pelanggaran</div>
                    <div class="detail-value text-danger"><?php echo e($service->indikasi_pelanggaran ?? '-'); ?></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Duga Langgar</div>
                    <div class="detail-value pre-wrap"><?php echo e($service->duga_langgar ?? '-'); ?></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Period Violation</div>
                    <div class="detail-value">
                        <?php echo e($service->period_violation_start ? $service->period_violation_start->format('d/m/Y') : '-'); ?> s.d 
                        <?php echo e($service->period_violation_end ? $service->period_violation_end->format('d/m/Y') : '-'); ?>

                    </div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Pelabuhan Keluar Terakhir</div>
                    <div class="detail-value"><?php echo e($service->pelabuhan_keluar_terakhir ?? '-'); ?></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Mulai Melanggar</div>
                    <div class="detail-value"><?php echo e($service->mulai_melanggar ? $service->mulai_melanggar->format('d M Y') : '-'); ?></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Frekuensi Pelanggaran</div>
                    <div class="detail-value"><?php echo e($service->frekuensi_pelanggaran ? $service->frekuensi_pelanggaran . ' kali' : '-'); ?></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">UPT Terdekat</div>
                    <div class="detail-value"><?php echo e($service->upt_terdekat ?? '-'); ?></div>
                </div>
            </div>
        </div>

        
        <div class="detail-section">
            <div class="detail-section-header bg-secondary text-white">
                <i class="fas fa-file-alt"></i> 5. Surat Analisis DIR POA & Dokumen
            </div>
            <div class="detail-section-body">
                <div class="detail-row">
                    <div class="detail-label">Nomor Surat Analisis</div>
                    <div class="detail-value fw-semibold"><?php echo e($service->surat_analisis_nomor ?? '-'); ?></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">SKAT Nomor</div>
                    <div class="detail-value"><?php echo e($service->skat_nomor ?? '-'); ?></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Masa Berlaku</div>
                    <div class="detail-value"><?php echo e($service->masa_berlaku ? \Carbon\Carbon::parse($service->masa_berlaku)->format('d M Y') : '-'); ?></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Titik Lokasi (Koordinat)</div>
                    <div class="detail-value">
                        <?php if($service->latitude && $service->longitude): ?>
                        <?php echo e($service->latitude); ?>, <?php echo e($service->longitude); ?>

                        <a href="https://maps.google.com/?q=<?php echo e($service->latitude); ?>,<?php echo e($service->longitude); ?>" target="_blank" class="ms-2 btn btn-xs btn-outline-primary"><i class="fas fa-map-marker-alt"></i> Buka Map</a>
                        <?php else: ?>
                        -
                        <?php endif; ?>
                    </div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Tanggal Pengamatan</div>
                    <div class="detail-value"><?php echo e($service->observation_date ? $service->observation_date->format('d M Y') : '-'); ?></div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-4">
        
        <div class="card mb-3 border-0 shadow-sm">
            <div class="card-header bg-white"><i class="fas fa-comments me-2 text-primary"></i>Tanggapan Pemilik Kapal</div>
            <div class="card-body">
                <?php if($service->company_response): ?>
                <div class="bg-primary-soft p-3 rounded-md mb-2">
                    <p class="mb-1"><?php echo e($service->company_response); ?></p>
                    <small class="text-muted"><?php echo e($service->responded_at ? $service->responded_at->format('d M Y H:i') : ''); ?></small>
                </div>
                <?php else: ?>
                <div class="empty-state py-2">
                    <i class="fas fa-comment-slash empty-state-icon" style="font-size: 1.5rem;"></i>
                    <div class="empty-state-text mt-2">Belum ada tanggapan dari pemilik kapal.</div>
                </div>
                <?php endif; ?>
            </div>
        </div>

        
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white"><i class="fas fa-history me-2 text-primary"></i>Riwayat & Dokumen</div>
            <div class="card-body">
                <ul class="timeline">
                    
                    <li class="timeline-item">
                        <div class="timeline-icon document"><i class="fas fa-plus"></i></div>
                        <div class="timeline-date"><?php echo e($service->created_at ? $service->created_at->format('d M Y H:i') : '-'); ?></div>
                        <div class="timeline-content">
                            <div class="fw-bold fs-sm">Pelayanan Dibuat</div>
                            <div class="text-muted fs-xs">Oleh: <?php echo e($service->creator->name ?? 'Sistem'); ?></div>
                        </div>
                    </li>

                    
                    <?php $__currentLoopData = $service->documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="timeline-item">
                        <div class="timeline-icon mail"><i class="fas fa-file-pdf"></i></div>
                        <div class="timeline-date"><?php echo e($doc->created_at ? $doc->created_at->format('d M Y H:i') : '-'); ?></div>
                        <div class="timeline-content">
                            <div class="fw-bold fs-sm"><?php echo e($doc->type ?? 'Dokumen Tambahan'); ?></div>
                            <?php if($doc->nomor_surat): ?>
                            <div class="text-primary fs-xs mb-1"><?php echo e($doc->nomor_surat); ?></div>
                            <?php endif; ?>
                            <a href="<?php echo e(asset('storage/'.$doc->file_path)); ?>" target="_blank" class="btn btn-xs btn-outline-primary mt-1">
                                <i class="fas fa-download me-1"></i>Unduh
                            </a>
                        </div>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
.pre-wrap { white-space: pre-wrap; word-break: break-word; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<?php if(session('open_wa_link')): ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        window.open("<?php echo e(session('open_wa_link')); ?>", "_blank");
    });
</script>
<?php endif; ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\pelayanan psdkp\resources\views/services/show.blade.php ENDPATH**/ ?>