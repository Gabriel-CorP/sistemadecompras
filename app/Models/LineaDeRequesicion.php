<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineaDeRequesicion extends Model
{
    use HasFactory;
    protected $fillable = [//campos de la BD
        'nombre_articulo',
        'unidad_articulo',
        'cantidad_articulo',
        'requesicion_id'

    ];
}
