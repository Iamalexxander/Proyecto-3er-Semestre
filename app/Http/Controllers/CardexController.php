<?php

namespace App\Http\Controllers;

use App\Models\Cardex;
use App\Models\Producto;
use Illuminate\Http\Request;

class CardexController extends Controller
{
    public function index()
    {
        $cardex = Cardex::with('producto')->orderBy('fecha', 'desc')->get();
        $productos = Producto::all(); // Necesario para el modal de nuevo movimiento
        return view('admin.cardex.index', compact('cardex', 'productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'tipo_movimiento' => 'required|in:venta,compra',
            'cantidad' => 'required|integer|min:1',
        ]);

        $producto = Producto::findOrFail($request->producto_id);

        // Calcular el nuevo saldo
        $saldo_actual = $producto->cantidad_disponible;
        if ($request->tipo_movimiento == 'compra') {
            $nuevo_saldo = $saldo_actual + $request->cantidad;
            $producto->cantidad_disponible = $nuevo_saldo;
        } else { // venta
            if ($saldo_actual < $request->cantidad) {
                return back()->with('error', 'No hay suficiente stock disponible');
            }
            $nuevo_saldo = $saldo_actual - $request->cantidad;
            $producto->cantidad_disponible = $nuevo_saldo;
        }

        // Guardar el movimiento en cardex
        Cardex::create([
            'producto_id' => $request->producto_id,
            'tipo_movimiento' => $request->tipo_movimiento,
            'cantidad' => $request->cantidad,
            'fecha' => now(),
            'saldo' => $nuevo_saldo
        ]);

        // Actualizar el stock del producto
        $producto->save();

        return redirect()->route('admin.cardex.index')
            ->with('success', 'Movimiento registrado exitosamente');
    }

    public function create()
    {
        $productos = Producto::all();
        return view('admin.cardex.create', compact('productos'));
    }

    // In CardexController.php, add:
public function edit($id)
{
    $cardex = Cardex::findOrFail($id);
    $productos = Producto::all();
    return view('admin.cardex.edit', compact('cardex', 'productos'));
}

public function update(Request $request, $id)
{
    $cardex = Cardex::findOrFail($id);

    $request->validate([
        'producto_id' => 'required|exists:productos,id',
        'tipo_movimiento' => 'required|in:venta,compra',
        'cantidad' => 'required|integer|min:1',
    ]);

    // Revertir el movimiento anterior
    $producto = Producto::findOrFail($cardex->producto_id);
    if ($cardex->tipo_movimiento == 'compra') {
        $producto->cantidad_disponible -= $cardex->cantidad;
    } else {
        $producto->cantidad_disponible += $cardex->cantidad;
    }

    // Aplicar el nuevo movimiento
    if ($request->tipo_movimiento == 'compra') {
        $producto->cantidad_disponible += $request->cantidad;
    } else {
        if ($producto->cantidad_disponible < $request->cantidad) {
            return back()->with('error', 'No hay suficiente stock disponible');
        }
        $producto->cantidad_disponible -= $request->cantidad;
    }

    $cardex->update([
        'producto_id' => $request->producto_id,
        'tipo_movimiento' => $request->tipo_movimiento,
        'cantidad' => $request->cantidad,
        'saldo' => $producto->cantidad_disponible
    ]);

    $producto->save();

    return redirect()->route('admin.cardex.index')
        ->with('success', 'Movimiento actualizado exitosamente');
}
}
