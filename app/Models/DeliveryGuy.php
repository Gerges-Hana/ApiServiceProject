<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class DeliveryGuy extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'id',
        'companyId',
        'name',
        'userName',
        'nationalId',
        'phone',
        'salary',
        'password',
        'motorCycleNumber',
        'email'
    ];

    public function company()
    {
        return $this->belongsTo(related: Company::class, foreignKey: 'companyId');
    }
}
