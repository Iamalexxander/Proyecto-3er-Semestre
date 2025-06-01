<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'cantidad_disponible',
        'categoria_id',
        'imagen'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function cardex()
    {
        return $this->hasMany(Cardex::class);
    }

    public function detallesFactura()
    {
        return $this->hasMany(DetalleFactura::class);
    }
    
    public function compras()
    {
        return $this->belongsToMany(Compra::class, 'compra_producto')
                    ->withPivot('cantidad', 'subtotal')
                    ->withTimestamps();
    }
}