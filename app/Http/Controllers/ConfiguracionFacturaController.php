<?php

namespace App\Http\Controllers;

use App\Models\ConfiguracionFactura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ConfiguracionFacturaController extends Controller
{
    public function edit()
    {
        $configuracion = ConfiguracionFactura::obtenerConfiguracion();
        return view('admin.configuracion_factura.edit', compact('configuracion'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nombre_empresa' => 'required|string|max:255',
            'nit' => 'required|string|max:50',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:50',
            'email' => 'required|email|max:255',
            'sitio_web' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'texto_footer' => 'nullable|string',
            'texto_condiciones' => 'nullable|string',
            'texto_agradecimiento' => 'nullable|string',
            'moneda' => 'nullable|string|max:10',
            'texto_firma' => 'nullable|string|max:255',
            'color_primario' => 'nullable|string|max:20',
            'mostrar_logo' => 'boolean'
        ]);

        $configuracion = ConfiguracionFactura::obtenerConfiguracion();
        
        // Manejar la carga del logo si hay uno nuevo
        if ($request->hasFile('logo')) {
            // Eliminar el logo anterior si existe
            if ($configuracion->logo && Storage::exists('public/' . $configuracion->logo)) {
                Storage::delete('public/' . $configuracion->logo);
            }
            
            // Guardar el nuevo logo
            $logoPath = $request->file('logo')->store('logos', 'public');
            $request->merge(['logo' => $logoPath]);
        }

        // Asegurarse de que mostrar_logo sea un booleano
        $request->merge(['mostrar_logo' => $request->has('mostrar_logo')]);
        
        $configuracion->update($request->all());

        return redirect()->route('admin.configuracion_factura.edit')
            ->with('success', 'Configuración de factura actualizada correctamente.');
    }
}