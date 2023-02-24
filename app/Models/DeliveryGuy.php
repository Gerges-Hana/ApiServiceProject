<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryGuy extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'companyId',
        'name',
        'userName',
        'nationalId',
        'phone',
        'salary',
    ];
}
