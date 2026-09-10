<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceDocument extends Model
{
    protected $fillable = ['service_request_id', 'type', 'nomor_surat', 'file_path', 'original_name'];

    public function serviceRequest(): BelongsTo { return $this->belongsTo(ServiceRequest::class); }
}
