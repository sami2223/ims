<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'student_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Expenses()
    {
        return $this->hasMany(Expense::class, 'created_by');
    }

    public function EventsCreatedBy()
    {
        return $this->hasMany(Event::class, 'created_by');
    }

    public function EventUpdatedBy()
    {
        return $this->hasMany(Event::class, 'updated_by');
    }

    public function SalaryCreatedBy()
    {
        return $this->hasMany(Salary::class, 'created_by');
    }

    public function SalaryUpdatedBy()
    {
        return $this->hasMany(Salary::class, 'updated_by');
    }
}
