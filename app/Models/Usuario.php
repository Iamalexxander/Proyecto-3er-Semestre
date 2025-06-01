<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'nombre_usuario',
        'email',
        'password',
        'rol_id',
        'telefono',
        'direccion'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function rol()
    {
        return $this->belongsTo(\Spatie\Permission\Models\Role::class, 'rol_id');
    }

    public function compras()
    {
        return $this->hasMany(Compra::class, 'user_id');
    }
}