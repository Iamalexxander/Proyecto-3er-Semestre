<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfiguracionFactura extends Model
{
    use HasFactory;

    protected $table = 'configuraciones_factura';

    protected $fillable = [
        'nombre_empresa',
        'nit',
        'direccion',
        'telefono',
        'email',
        'sitio_web',
        'logo',
        'texto_footer',
        'texto_condiciones',
        'texto_agradecimiento',
        'moneda',
        'texto_firma',
        'color_primario',
        'mostrar_logo'
    ];

    // Obtenemos la configuración activa o creamos una por defecto
    public static function obtenerConfiguracion()
    {
        $config = self::first();
        
        if (!$config) {
            $config = self::create([
                'nombre_empresa' => 'Nigth Fox Club',
                'nit' => '987654321',
                'direccion' => 'Chillogallo, Calle Principal #123',
                'telefono' => '0969701551',
                'email' => 'yohelitoalex79@gmail.com',
                'sitio_web' => 'nightfoxclub.com',
                'texto_footer' => 'Gracias por su compra! Para cualquier consulta, contáctenos.',
                'texto_condiciones' => 'Esta factura constituye un documento oficial.',
                'texto_agradecimiento' => '¡Gracias por su compra!',
                'moneda' => '$',
                'texto_firma' => 'Todos los derechos reservados',
                'color_primario' => '#0066cc',
                'mostrar_logo' => false
            ]);
        }
        
        return $config;
    }
}