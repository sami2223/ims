<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $fillable = [
        'expense_type_id',
        'amount',
        'dated',
        'created_by',
        'updated_by'
    ];

    public function ExpenseType()
    {
        return $this->belongsTo(ExpenseType::class);
    }

    public function RecordUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
