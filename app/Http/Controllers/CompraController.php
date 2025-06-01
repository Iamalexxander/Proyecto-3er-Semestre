<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\ConfiguracionFactura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class CompraController extends Controller
{
    public function index()
    {
        $compras = Compra::where('user_id', Auth::id())
            ->with(['productos'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('usuarios.compras.index', compact('compras'));
    }

    public function show(Compra $compra)
    {
        if ($compra->user_id !== Auth::id()) {
            abort(403, 'No autorizado');
        }

        $compra->load(['productos', 'usuario']);

        return view('usuarios.compras.show', compact('compra'));
    }

    public function downloadInvoice(Compra $compra)
    {
        // Verificar que el usuario actual sea el dueño de la compra o un administrador
        if (Auth::id() !== $compra->user_id && !Auth::user()->hasRole('admin')) {
            return redirect()->back()->with('error', 'No tienes permiso para ver esta factura.');
        }

        // Cargar las relaciones necesarias
        $compra->load(['productos', 'usuario']);
        
        // Actualizar el estado de la compra a "completada"
        $compra->estado = 'completada';
        $compra->save();

        // Generar el PDF
        $pdf = PDF::loadView('usuarios.compras.invoice', compact('compra'));
        
        // Establecer opciones del PDF
        $pdf->setPaper('a4', 'portrait');
        
        // Descargar el PDF con un nombre significativo
        return $pdf->download('factura-' . $compra->id . '.pdf');
    }
}