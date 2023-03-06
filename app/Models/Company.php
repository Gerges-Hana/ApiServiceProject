<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Company extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'name',
        'userName',
        'email',
        'password',
        'city',
        'street',
    ];
    public function invoices(){
    
        return $this->hasMany(Invoice :: class,foreignKey: 'companyId');
    }
}
