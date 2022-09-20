<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificates extends Model
{
    use HasFactory;

    protected $fillable = [
        'received_by',
        'student_id',
        'cert_type_id',
        'issued',
        'issue_date',
    ];

    public function Student()
    {
        return $this->belongsTo(Student::class);
    }

    public function CertType()
    {
        return $this->belongsTo(CertType::class);
    }
}
