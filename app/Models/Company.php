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


}
