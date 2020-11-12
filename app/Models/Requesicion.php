<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requesicion extends Model
{
    use HasFactory;
    protected $fillable = [ //campos que se agregaran en la BD
        'elaborador_id',
        'estado',
        'aprobador_id',
        'comentario'
    ];

    public function lineasrequesicion(){
        return $this->hasMany(LineaDeRequesicion::class);
    }
}
