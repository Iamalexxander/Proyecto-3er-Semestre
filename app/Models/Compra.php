<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total',
        'estado',
        'direccion_envio'  // Como string, no como relación
    ];

    // Relación con el usuario - mantiene consistencia con el modelo Usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'user_id');
    }

    // Relación con los productos
    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'compra_producto')
                    ->withPivot('cantidad', 'subtotal')
                    ->withTimestamps();
    }
}