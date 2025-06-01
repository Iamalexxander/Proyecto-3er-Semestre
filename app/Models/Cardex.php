<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cardex extends Model
{
    use HasFactory;

    protected $table = 'cardex';

    protected $fillable = ['producto_id', 'tipo_movimiento', 'cantidad', 'fecha', 'saldo'];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
