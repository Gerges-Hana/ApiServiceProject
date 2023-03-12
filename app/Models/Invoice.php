<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'companyId',
        'deliveryGuyId',
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

    public function company()
    {
        return $this->belongsTo(related: Company::class, foreignKey: 'companyId');
    }

    public function delivery()
    {
        return $this->belongsTo(related: DeliveryGuy::class, foreignKey: 'deliveryGuyId');
    }

    public function invoice()
    {
        return $this->belongsTo(related: DeliveryGuy::class, foreignKey: 'deliveryGuyId');
    }

}
