<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use HasFactory;
    protected $fillable =[
        'student_id',
        'slip_id',
        'fee_type',
        'total_amount',
        'paid_amount',
        'balance',
        'for_month',
        'for_year'
    ];

    public function FeeSlip()
    {
        return $this->belongsTo(FeeSlip::class, 'slip_id');
    }

    public function Student()
    {
        return $this->belongsTo(Student::class);
    }
}
