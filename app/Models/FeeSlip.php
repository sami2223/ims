<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeSlip extends Model
{
    use HasFactory;
    protected $fillable = ['student_id', 'paid_amount', 'total_amount'];

    public function Fees()
    {
        return $this->hasMany(Fee::class,'slip_id');
    }

    public function Student()
    {
        return $this->belongsTo(Student::class,'student_id');
    }
}
