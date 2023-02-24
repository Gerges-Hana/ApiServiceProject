<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryStaff extends Model
{
    use HasFactory;

    private $fillable = [
        'id',
        'companyId',
        'name',
        'userName',
        'nationalId',
        'phone',
        'salary',
    ];
}
