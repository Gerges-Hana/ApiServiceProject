<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Veelasky\LaravelHashId\Eloquent\HashableId;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Company extends Authenticatable
{
    use HasFactory, HasApiTokens ;


    protected $fillable = [
        'name',
        'userName',
        'email',
        'password',
        'city',
        'street',
        'api_token',
    ];
    // public $count = 0;
    public function deliveries()
    {
        return $this->hasMany(related: DeliveryGuy::class, foreignKey: 'companyId');
    }
    public function invoices()
    {
        return $this->hasMany(related: Invoice::class, foreignKey: 'companyId');
    }


}
