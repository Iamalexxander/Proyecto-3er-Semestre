<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DireccionEnvio extends Model
{
    use HasFactory;

    protected $fillable = [
        'calle',
        'numero',
        'ciudad',
        'estado',
        'codigo_postal',
        'pais',
        'instrucciones_adicionales'
    ];

    public function compras()
    {
        return $this->hasMany(Compra::class);
    }
}
