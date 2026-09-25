<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceRequest extends Model
{
    protected $fillable = [
        'token', 'company_id', 'ship_id', 'created_by', 'category', 'subject', 
        'description', 'analysis', 'indikasi', 'indikasi_pelanggaran', 'duga_langgar',
        'period_violation_start', 'period_violation_end', 'pelabuhan_keluar_terakhir',
        'mulai_melanggar', 'frekuensi_pelanggaran', 'upt_terdekat', 'hasil_pengawasan', 'status', 
        'observation_date', 'latitude', 'longitude', 'company_response', 'officer_response', 
        'submitted_at', 'responded_at', 'analyst', 'verificator', 'unit_kerja', 
        'lembar_indikasi', 'surat_analisis_nomor', 'surat_analisis_dokumen', 'skat_nomor', 'masa_berlaku',
        'arrival_date', 'arrival_day', 'arrival_time', 'unique_code', 'attendance_type', 'attendance_notes', 'form_opened_at'
    ];

    protected $casts = [
        'observation_date' => 'date',
        'period_violation_start' => 'date',
        'period_violation_end' => 'date',
        'mulai_melanggar' => 'date',
        'arrival_date' => 'date',
        'submitted_at' => 'datetime',
        'responded_at' => 'datetime',
        'form_opened_at' => 'datetime',
    ];

    public function company(): BelongsTo { return $this->belongsTo(Company::class); }
    public function ship(): BelongsTo { return $this->belongsTo(Ship::class); }
    public function creator(): BelongsTo { return $this->belongsTo(User::class, 'created_by'); }
    public function documents(): HasMany { return $this->hasMany(ServiceDocument::class); }

    public function getWhatsappLink(): ?string
    {
        if (!$this->company || !$this->company->phone) return null;
        $phone = preg_replace('/[^0-9]/', '', $this->company->phone);
        if (str_starts_with($phone, '0')) $phone = '62' . substr($phone, 1);
        $url = url('/klaim');
        $kapal = $this->ship?->name ?? '-';
        $pemilik = $this->company?->name ?? '-';
        $homePort = $this->ship?->home_port ?? '';
        $size = $this->ship?->size ? 'GT.' . $this->ship->size : '';
        $bookNo = $this->ship?->book_no ?? '-';
        $tandaSelar = trim(($homePort ? $homePort . '/' : '') . $size) . ' No.' . $bookNo;
        $alatTangkap = $this->ship?->fishing_gear ?? '-';
        $hasilPengawasan = $this->hasil_pengawasan ?? '-';
        $tanggal = $this->observation_date ? \Carbon\Carbon::parse($this->observation_date)->translatedFormat('d F Y') : '-';
        $jenispelanggaran = $this->indikasi_pelanggaran ?? $this->description ?? '-';

        $uptMapsLinks = [
            'Bitung' => 'https://maps.app.goo.gl/ZxwduNteqVcL12Th6?g_st=aw',
        ];
        $mapsLine = '';
        if ($this->upt_terdekat && isset($uptMapsLinks[$this->upt_terdekat])) {
            $mapsLine = "\n\nLokasi Pangkalan PSDKP {$this->upt_terdekat}:\n{$uptMapsLinks[$this->upt_terdekat]}";
        }

        $msgRaw = "PEMBERITAHUAN HASIL PENGAWASAN\n\nSalam\n\nSehubungan dengan pelanggaran yang dilakukan oleh:\nNama Kapal: {$kapal}\nNama Pemilik: {$pemilik}\nTanda Selar: {$tandaSelar}\nAlat Tangkap: {$alatTangkap}\n\nHasil Pengawasan : {$hasilPengawasan}\nTanggal Pengawasan : {$tanggal}\nJenis Pelanggaran : {$jenispelanggaran}\n\nDalam rangka penanganan pelanggaran ini, mohon dapat melakukan klarifikasi melalui link berikut ini:\n{$url}\n\nLalu masukkan Kode Unik berikut:\n*{$this->unique_code}*{$mapsLine}";
        $msg = urlencode($msgRaw);
        return "https://wa.me/{$phone}?text={$msg}";
    }
}
