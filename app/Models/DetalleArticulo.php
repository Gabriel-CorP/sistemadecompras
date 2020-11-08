<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleArticulo extends Model
{
    use HasFactory;
    protected $fillable = [//campos de la BD
        'precio',
        'descuento',
        'fechafindescuento',
    ];

}
