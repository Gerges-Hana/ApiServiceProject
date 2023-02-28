<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'companyId',
        'isPaid',
        'delivaryFees',
        'city',
        'street',
        'buildingNumber',
        'floorNumber',
        'apartmentNumber',
        'totalPrice',
        'orderDate',
        'clientName',
        'clientPhone',
        'invoiceCode',
    ];
}
