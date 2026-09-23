<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulir Pelayanan PSDKP</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --primary: #0A3D6B;
            --primary-light: #1A5288;
            --accent: #ECA313;
            --bg-color: #F4F7FA;
            --text-dark: #1E293B;
            --text-muted: #64748B;
            --card-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.01);
        }
        body { 
            background-color: var(--bg-color); 
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text-dark);
            -webkit-font-smoothing: antialiased;
            padding-bottom: 3rem;
        }
        
        /* Header Styling */
        .premium-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white;
            padding: 3rem 1.5rem;
            border-bottom-left-radius: 2.5rem;
            border-bottom-right-radius: 2.5rem;
            box-shadow: 0 4px 20px rgba(10, 61, 107, 0.2);
            position: relative;
            margin-bottom: -3rem;
            text-align: center;
        }
        .premium-header img {
            height: 70px;
            filter: drop-shadow(0px 4px 6px rgba(0,0,0,0.3));
            margin-bottom: 1rem;
        }
        .premium-header h3 {
            font-weight: 800;
            letter-spacing: 0.5px;
            margin-bottom: 0.25rem;
        }
        .premium-header p {
            color: rgba(255,255,255,0.8);
            font-weight: 600;
            font-size: 1rem;
        }

        /* Container */
        .public-wrap { 
            max-width: 700px; 
            margin: 0 auto; 
            padding: 0 1.25rem;
            position: relative;
            z-index: 10;
        }
        
        /* Cards */
        .glass-card {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            border-radius: 1.25rem;
            box-shadow: var(--card-shadow);
            border: 1px solid rgba(0,0,0,0.04);
            padding: 1.75rem;
            margin-bottom: 1.5rem;
            transition: transform 0.3s ease;
        }
        
        /* Info Grid */
        .info-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-muted);
            font-weight: 700;
            margin-bottom: 0.25rem;
        }
        .info-value {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 1rem;
            font-size: 0.95rem;
            line-height: 1.5;
        }
        .info-value.danger {
            color: #E11D48;
        }

        /* Forms */
        .form-label {
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }
        .form-control, .form-select {
            border-radius: 0.75rem;
            border: 1px solid #E2E8F0;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            font-weight: 500;
            background-color: #F8FAFC;
            transition: all 0.2s ease;
        }
        .form-control:focus, .form-select:focus {
            background-color: white;
            border-color: var(--primary-light);
            box-shadow: 0 0 0 4px rgba(10, 61, 107, 0.1);
        }
        
        /* Custom Radios for Kehadiran */
        .attendance-options {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }
        .radio-card {
            position: relative;
        }
        .radio-card input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }
        .radio-card label {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            width: 100%;
            padding: 1rem;
            background: white;
            border: 2px solid #E2E8F0;
            border-radius: 0.75rem;
            cursor: pointer;
            font-weight: 700;
            color: var(--text-muted);
            transition: all 0.2s ease;
        }
        .radio-card input:checked + label {
            border-color: var(--primary);
            background: rgba(10, 61, 107, 0.05);
            color: var(--primary);
        }
        .radio-card input:checked + label i {
            color: var(--primary);
        }
        
        /* File Upload */
        .file-upload-box {
            background: #F8FAFC;
            border: 1.5px dashed #CBD5E1;
            border-radius: 0.75rem;
            padding: 1rem;
            transition: all 0.2s ease;
        }
        .file-upload-box:hover {
            border-color: var(--primary-light);
            background: rgba(10, 61, 107, 0.02);
        }
        .file-upload-box input[type="file"] {
            font-size: 0.8rem;
            color: var(--text-muted);
            width: 100%;
        }
        .file-upload-box input[type="file"]::file-selector-button {
            background: var(--primary);
            color: white;
            border: none;
            padding: 0.4rem 0.8rem;
            border-radius: 0.5rem;
            margin-right: 1rem;
            font-weight: 600;
            transition: background 0.2s;
            cursor: pointer;
        }
        .file-upload-box input[type="file"]::file-selector-button:hover {
            background: var(--primary-light);
        }

        /* Buttons */
        .btn-premium {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            border: none;
            color: white;
            padding: 1rem;
            border-radius: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 15px rgba(10, 61, 107, 0.3);
            transition: all 0.3s ease;
        }
        .btn-premium:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(10, 61, 107, 0.4);
            color: white;
        }
        
        .section-title {
            font-weight: 800;
            font-size: 1.1rem;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }
        
    </style>
</head>
<body>

<div class="premium-header">
    <img src="{{ asset('images/logo.png') }}" alt="Logo PSDKP" style="filter: drop-shadow(0 0 10px rgba(255, 255, 255, 1));">
    <h3>SIKAP PSDKP</h3>
    <p class="mb-0"><i class="fas fa-ship me-2"></i>{{ $service->ship->name ?? 'Kapal Tidak Diketahui' }}</p>
</div>

<div class="public-wrap">
    
    <!-- Info Card -->
    <div class="glass-card mt-4">
        <div class="section-title border-bottom pb-3">
            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width:32px; height:32px;">
                <i class="fas fa-info fs-6"></i>
            </div>
            Detail Pelanggaran
        </div>
        
        <div class="row">
            <div class="col-12 col-md-12 mt-2">
                <div class="info-label">Subjek</div>
                <div class="info-value">{{ $service->subject }}</div>
            </div>
            <div class="col-6 col-md-6 mt-2">
                <div class="info-label">Pemilik Kapal</div>
                <div class="info-value">{{ $service->company->name ?? '-' }}</div>
            </div>
            <div class="col-6 col-md-6 mt-2">
                <div class="info-label">Tgl Pengamatan</div>
                <div class="info-value">{{ $service->observation_date ? $service->observation_date->format('d M Y') : '-' }}</div>
            </div>
            
            <div class="col-12 mt-2">
                <div class="info-label">Indikasi</div>
                <div class="info-value danger"><i class="fas fa-exclamation-triangle me-1"></i> {{ $service->indikasi ?? '-' }}</div>
            </div>
            
            <div class="col-12 mt-2">
                <div class="info-label">Analisis</div>
                <div class="info-value" style="font-weight: 500;">{{ $service->analysis ?? '-' }}</div>
            </div>
            
            <div class="col-12 mt-2">
                <div class="info-label">Dugaan Pelanggaran</div>
                <div class="info-value">{{ $service->duga_langgar ?? '-' }}</div>
            </div>
            
            <div class="col-12 mt-2">
                <div class="info-label">Periode Pelanggaran</div>
                <div class="info-value">
                    {{ $service->period_violation_start ? $service->period_violation_start->format('d M Y') : '-' }} s/d 
                    {{ $service->period_violation_end ? $service->period_violation_end->format('d M Y') : '-' }}
                </div>
            </div>
            
            <div class="col-6 col-md-6 mt-2">
                <div class="info-label">Pelabuhan Keluar</div>
                <div class="info-value">{{ $service->pelabuhan_keluar_terakhir ?? '-' }}</div>
            </div>
            <div class="col-6 col-md-6 mt-2">
                <div class="info-label">UPT Terdekat</div>
                <div class="info-value">{{ $service->upt_terdekat ?? '-' }}</div>
            </div>
        </div>
    </div>

    <!-- Documents Card -->
    @if($service->documents->count() > 0)
    <div class="glass-card">
        <div class="section-title border-bottom pb-3">
            <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center" style="width:32px; height:32px;">
                <i class="fas fa-paperclip fs-6"></i>
            </div>
            Dokumen Lampiran Admin
        </div>
        <div class="d-flex flex-column gap-3 mt-3">
            @foreach($service->documents as $doc)
            <div class="d-flex justify-content-between align-items-center p-3 rounded-3" style="background: #F8FAFC; border: 1px solid #E2E8F0;">
                <div>
                    <div class="fw-bold text-dark" style="font-size: 0.9rem;">{{ $doc->type ?? 'Dokumen' }}</div>
                    <div class="text-muted" style="font-size: 0.75rem;">{{ $doc->nomor_surat ?? 'Tanpa Nomor' }}</div>
                </div>
                <a href="{{ asset('storage/'.$doc->file_path) }}" target="_blank" class="btn btn-sm btn-primary rounded-circle shadow-sm" style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-download"></i>
                </a>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Form Card -->
    <div class="glass-card">
        <div class="section-title mb-4">
            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width:32px; height:32px;">
                <i class="fas fa-edit fs-6"></i>
            </div>
            Formulir Tanggapan
        </div>
        
        @if (session('success'))
            <div class="alert alert-success d-flex align-items-center rounded-3 mb-4 shadow-sm" style="border:none; border-left: 4px solid #10B981; background: #ECFDF5;">
                <i class="fas fa-check-circle fs-3 text-success me-3"></i>
                <div>
                    <div class="fw-bold text-success mb-1">Berhasil!</div>
                    <div style="font-size:0.9rem; color: #065F46;">{{ session('success') }}</div>
                </div>
            </div>
        @endif

        @if ($service->status == 'submitted')
            <div class="alert alert-info d-flex align-items-center rounded-3 shadow-sm" style="border:none; border-left: 4px solid #3B82F6; background: #EFF6FF;">
                <i class="fas fa-info-circle fs-3 text-info me-3"></i>
                <div>
                    <div class="fw-bold text-info mb-1">Telah Disubmit</div>
                    <div style="font-size:0.9rem; color: #1E40AF;">Anda telah mengirimkan tanggapan dan jadwal kehadiran untuk pelayanan ini. Terima kasih!</div>
                </div>
            </div>
        @else
            @if ($errors->any())
                <div class="alert alert-danger rounded-3 shadow-sm border-0" style="border-left: 4px solid #EF4444; background: #FEF2F2;">
                    <ul class="mb-0 fs-sm" style="color: #991B1B;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('public.form.store', $service->token) }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row g-3 mb-4">
                    <div class="col-6 col-md-4">
                        <label class="form-label">Tanggal Datang <span class="text-danger">*</span></label>
                        <input type="date" name="arrival_date" id="arrival_date" class="form-control" value="{{ old('arrival_date', $service->arrival_date?->format('Y-m-d')) }}" required>
                    </div>
                    <div class="col-6 col-md-4">
                        <label class="form-label">Hari <span class="text-danger">*</span></label>
                        <input type="text" name="arrival_day" id="arrival_day" class="form-control" value="{{ old('arrival_day', $service->arrival_day) }}" readonly required style="background-color: #E2E8F0; cursor: not-allowed; color: #64748B;">
                    </div>
                    <div class="col-12 col-md-4 mt-3 mt-md-0">
                        <label class="form-label">Jam Datang <span class="text-danger">*</span></label>
                        <select name="arrival_time" class="form-select" required>
                            <option value="">-- Pilih Jam --</option>
                            <option value="09:00" {{ old('arrival_time', $service->arrival_time) == '09:00' ? 'selected' : '' }}>09:00</option>
                            <option value="11:00" {{ old('arrival_time', $service->arrival_time) == '11:00' ? 'selected' : '' }}>11:00</option>
                            <option value="14:00" {{ old('arrival_time', $service->arrival_time) == '14:00' ? 'selected' : '' }}>14:00</option>
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label mb-2">Tipe Kehadiran (Bisa pilih maksimal 2) <span class="text-danger">*</span></label>
                    <div class="attendance-options">
                        @php $selectedAttendance = old('attendance_type', $service->attendance_type ? explode(',', $service->attendance_type) : []); @endphp
                        <div class="radio-card">
                            <input type="checkbox" name="attendance_type[]" id="hadir_pemilik" value="pemilik" {{ in_array('pemilik', $selectedAttendance) ? 'checked' : '' }}>
                            <label for="hadir_pemilik"><i class="fas fa-user-tie"></i> Pemilik</label>
                        </div>
                        <div class="radio-card">
                            <input type="checkbox" name="attendance_type[]" id="hadir_nahkoda" value="nahkoda" {{ in_array('nahkoda', $selectedAttendance) ? 'checked' : '' }}>
                            <label for="hadir_nahkoda"><i class="fas fa-ship"></i> Nahkoda</label>
                        </div>
                        <div class="radio-card">
                            <input type="checkbox" name="attendance_type[]" id="diwakilkan" value="diwakilkan" {{ in_array('diwakilkan', $selectedAttendance) ? 'checked' : '' }}>
                            <label for="diwakilkan"><i class="fas fa-users"></i> Diwakilkan</label>
                        </div>
                    </div>
                    @error('attendance_type')
                        <div class="text-danger fs-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4" id="keterangan_kehadiran_container" style="display: none;">
                    <div class="p-3 bg-light border rounded">
                        <label class="form-label">Keterangan Perwakilan <span class="text-danger">*</span></label>
                        <input type="text" name="attendance_notes" id="attendance_notes" class="form-control mb-3" value="{{ old('attendance_notes', $service->attendance_notes) }}" placeholder="Contoh: Budi (Manajer)">
                        
                        <label class="form-label text-danger">Unggah Surat Kuasa <span class="text-danger">*</span></label>
                        <div class="file-upload-box mb-0">
                            <label class="form-label fs-sm text-muted mb-2"><i class="fas fa-file-pdf me-1"></i> Surat Kuasa (.pdf/.png/.jpg)</label>
                            <input type="file" name="doc_surat_kuasa" id="doc_surat_kuasa" class="form-control form-control-sm" accept=".pdf,.png,.jpg,.jpeg">
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label d-flex align-items-center gap-2 mb-3">
                        <i class="fas fa-cloud-upload-alt text-primary"></i> Unggah Dokumen (Opsional)
                    </label>
                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <div class="file-upload-box">
                                <label class="form-label fs-sm text-muted mb-2"><i class="fas fa-user-md me-1"></i> Suket Dokter (.pdf/.png/.jpg)</label>
                                <input type="file" name="doc_keterangan_dokter" class="form-control form-control-sm" accept=".pdf,.png,.jpg,.jpeg">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="file-upload-box">
                                <label class="form-label fs-sm text-muted mb-2"><i class="fas fa-receipt me-1"></i> Kwitansi Logistik (.pdf/.png/.jpg)</label>
                                <input type="file" name="doc_kwitansi" class="form-control form-control-sm" accept=".pdf,.png,.jpg,.jpeg">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="file-upload-box">
                                <label class="form-label fs-sm text-muted mb-2"><i class="fas fa-cloud-sun-rain me-1"></i> Cuaca/BMKG (.png/.jpg)</label>
                                <input type="file" name="doc_cuaca" class="form-control form-control-sm" accept=".png,.jpg,.jpeg">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Klarifikasi Tambahan (Opsional)</label>
                    <textarea name="response" class="form-control" rows="4" placeholder="Tulis penjelasan Anda di sini...">{{ old('response', $service->company_response) }}</textarea>
                </div>
                
                <button type="submit" class="btn btn-premium w-100 mt-2">
                    <i class="fas fa-paper-plane me-2"></i>Kirim Jadwal & Dokumen
                </button>
            </form>
        @endif
    </div>
    
    <div class="text-center mt-4 mb-3">
        <small class="text-muted fw-semibold">&copy; {{ date('Y') }} Direktorat Jenderal PSDKP.</small>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dateInput = document.getElementById('arrival_date');
        const dayInput = document.getElementById('arrival_day');
        
        const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        dateInput?.addEventListener('change', function() {
            if (this.value) {
                const date = new Date(this.value);
                const dayName = days[date.getDay()];
                dayInput.value = dayName;
            } else {
                dayInput.value = '';
            }
        });
        
        if (dateInput?.value && !dayInput?.value) {
            dateInput.dispatchEvent(new Event('change'));
        }

        const checkboxPemilik = document.getElementById('hadir_pemilik');
        const checkboxNahkoda = document.getElementById('hadir_nahkoda');
        const checkboxDiwakilkan = document.getElementById('diwakilkan');
        const ketContainer = document.getElementById('keterangan_kehadiran_container');
        const ketInput = document.getElementById('attendance_notes');
        const docSuratKuasa = document.getElementById('doc_surat_kuasa');
        const attendanceCheckboxes = document.querySelectorAll('input[name="attendance_type[]"]');

        function toggleKeterangan() {
            if (checkboxDiwakilkan && checkboxDiwakilkan.checked) {
                ketContainer.style.display = 'block';
                ketInput.setAttribute('required', 'required');
                docSuratKuasa.setAttribute('required', 'required');
            } else {
                ketContainer.style.display = 'none';
                ketInput.removeAttribute('required');
                docSuratKuasa.removeAttribute('required');
            }
        }

        attendanceCheckboxes.forEach(cb => {
            cb.addEventListener('change', function() {
                const checkedCount = document.querySelectorAll('input[name="attendance_type[]"]:checked').length;
                if (checkedCount > 2) {
                    this.checked = false;
                    alert('Maksimal 2 pilihan kehadiran yang dapat dipilih.');
                }
                toggleKeterangan();
            });
        });
        
        if (checkboxDiwakilkan?.checked) {
            toggleKeterangan();
        }
    });
</script>
</body>
</html>
