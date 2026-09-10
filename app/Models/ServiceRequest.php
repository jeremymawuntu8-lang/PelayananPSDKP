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
        'mulai_melanggar', 'frekuensi_pelanggaran', 'upt_terdekat', 'status', 
        'observation_date', 'latitude', 'longitude', 'company_response', 'officer_response', 
        'submitted_at', 'responded_at', 'analyst', 'verificator', 'unit_kerja', 
        'lembar_indikasi', 'surat_analisis_nomor', 'surat_analisis_dokumen', 'skat_nomor', 'masa_berlaku',
        'arrival_date', 'arrival_day', 'arrival_time', 'unique_code', 'attendance_type', 'attendance_notes'
    ];

    protected $casts = [
        'observation_date' => 'date',
        'period_violation_start' => 'date',
        'period_violation_end' => 'date',
        'mulai_melanggar' => 'date',
        'arrival_date' => 'date',
        'submitted_at' => 'datetime',
        'responded_at' => 'datetime',
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
        $msg = urlencode("Yth. {$this->company->name},\n\nTerdapat pemberitahuan/pelayanan PSDKP baru untuk kapal Anda.\n\nSilakan kunjungi sistem kami di:\n{$url}\n\nLalu masukkan Kode Unik berikut untuk membuka dokumen Anda:\n*{$this->unique_code}*\n\nTerima kasih,\nPSDKP Pelayanan");
        return "https://wa.me/{$phone}?text={$msg}";
    }
}
