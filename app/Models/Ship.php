<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ship extends Model
{
    protected $fillable = [
        'company_id', 'name', 'transmitter_no', 'book_no', 'fishing_gear', 'size',
        'sipi_no', 'sipi_start', 'sipi_end', 'dpi', 'home_port',
        'pelabuhan_keluar_terakhir', 'slo_issuer', 'license_type'
    ];

    protected $casts = ['sipi_start' => 'date', 'sipi_end' => 'date'];

    public function company(): BelongsTo { return $this->belongsTo(Company::class); }
    public function serviceRequests(): HasMany { return $this->hasMany(ServiceRequest::class); }
}
