<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeType extends Model
{
    use HasFactory;
    protected $fillable = ['fee_type'];

    public function Fees()
    {
        return $this->hasMany(Fee::class);
    }

    public function AddFeeAmount()
    {
        return $this->hasMany(AddFee::class, 'feetype_id');
    }
}
