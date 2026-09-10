<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    protected $fillable = ['name', 'phone', 'email', 'address'];

    public function users(): HasMany { return $this->hasMany(User::class); }
    public function ships(): HasMany { return $this->hasMany(Ship::class); }
    public function serviceRequests(): HasMany { return $this->hasMany(ServiceRequest::class); }
}
