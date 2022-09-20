<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertType extends Model
{
    use HasFactory;
    
    protected $fillable = ['cert_type'];

    public function Certificates()
    {
        return $this->hasMany(Certificates::class);
    }
}
