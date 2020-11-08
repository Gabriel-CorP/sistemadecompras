<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;

    protected $fillable = [ //campos que se agregaran en la BD
        'nombre',
        'unidad',
        'detalle_articulos_id',
        'user_id'
    ];

    public function detallearticulos(){
        return $this->belongsTo(DetalleArticulo::class);
    }
}
