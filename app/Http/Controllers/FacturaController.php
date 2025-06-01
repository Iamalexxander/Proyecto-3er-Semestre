<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Factura;
use App\Models\Compra;
use App\Models\Configuracion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FacturaController extends Controller
{
    public function index()
    {
        $facturas = Compra::with('usuario')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.facturas.index', compact('facturas'));
    }
    
    public function show($id)
    {
        $compra = Compra::with(['usuario', 'productos'])->findOrFail($id);
        return view('admin.facturas.show', compact('compra'));
    }
    
    public function configuracion()
    {
        $configuracion = Configuracion::where('tipo', 'factura')->first();
        
        if (!$configuracion) {
            $configuracion = new Configuracion();
            $configuracion->tipo = 'factura';
            $configuracion->datos = json_encode([
                'empresa_nombre' => 'Nigth Fox Club',
                'empresa_ruc' => '1791274563001',
                'empresa_direccion' => 'MARISCAL SUCRE SN Y Canelo Centro Comercial Atahualpa',
                'empresa_telefono' => '0969701551',
                'empresa_email' => 'yohelitoalex79@gmail.com',
                'empresa_sitio_web' => 'www.nightfoxclub.com',
                'factura_ambiente' => 'PRODUCCION',
                'factura_emision' => 'NORMAL',
                'factura_serie' => '001-100',
                'impuesto_iva' => 15,
            ]);
            $configuracion->save();
        }
        
        $datos = json_decode($configuracion->datos, true);
        return view('admin.facturas.configuracion', compact('datos'));
    }
    
    public function actualizarConfiguracion(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'empresa_nombre' => 'required|string|max:255',
            'empresa_ruc' => 'required|string|max:20',
            'empresa_direccion' => 'required|string|max:255',
            'empresa_telefono' => 'required|string|max:20',
            'empresa_email' => 'required|email|max:255',
            'empresa_sitio_web' => 'nullable|string|max:255',
            'factura_ambiente' => 'required|string|max:100',
            'factura_emision' => 'required|string|max:100',
            'factura_serie' => 'required|string|max:20',
            'impuesto_iva' => 'required|numeric|min:0|max:100',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $configuracion = Configuracion::where('tipo', 'factura')->first();
        
        if (!$configuracion) {
            $configuracion = new Configuracion();
            $configuracion->tipo = 'factura';
        }
        
        $configuracion->datos = json_encode($request->except('_token'));
        $configuracion->save();
        
        return redirect()->route('admin.facturas.configuracion')
            ->with('success', 'Configuración de factura actualizada correctamente');
    }
    
    public function generarFactura($id)
    {
        $compra = Compra::with(['usuario', 'productos'])->findOrFail($id);
        $configuracion = Configuracion::where('tipo', 'factura')->first();
        $config = json_decode($configuracion->datos, true);
        
        $pdf = \PDF::loadView('admin.facturas.pdf', compact('compra', 'config'));
        return $pdf->download('factura-' . str_pad($compra->id, 6, '0', STR_PAD_LEFT) . '.pdf');
    }
    
    public function verFactura($id)
    {
        $compra = Compra::with(['usuario', 'productos'])->findOrFail($id);
        $configuracion = Configuracion::where('tipo', 'factura')->first();
        $config = json_decode($configuracion->datos, true);
        
        return view('admin.facturas.ver', compact('compra', 'config'));
    }
}