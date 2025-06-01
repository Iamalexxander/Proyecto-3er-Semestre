<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Compra;
use App\Models\Cardex;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CarritoController extends Controller
{
    public function agregarAlCarrito(Request $request, Producto $producto)
    {
        if ($producto->cantidad_disponible <= 0) {
            return redirect()->back()->with('error', 'Producto agotado');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$producto->id])) {
            if ($cart[$producto->id]['cantidad'] >= $producto->cantidad_disponible) {
                return redirect()->back()->with('error', 'No hay suficiente stock disponible');
            }
            $cart[$producto->id]['cantidad']++;
        } else {
            $cart[$producto->id] = [
                "nombre" => $producto->nombre,
                "cantidad" => 1,
                "precio" => $producto->precio,
                "imagen" => $producto->imagen
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('carrito.mostrar')->with('success', 'Producto agregado al carrito!');
    }

    public function mostrarCarrito()
    {
        return view('usuarios.carrito.index');
    }

    public function eliminarDelCarrito(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            return redirect()->back()->with('success', 'Producto eliminado del carrito!');
        }
    }

    public function procesarCompra()
    {
        $cart = session()->get('cart');
        if (!$cart) {
            return redirect()->back()->with('error', 'El carrito está vacío!');
        }

        try {
            DB::beginTransaction();

            $total = 0;
            foreach ($cart as $id => $detalles) {
                $producto = Producto::find($id);
                if ($producto->cantidad_disponible < $detalles['cantidad']) {
                    throw new \Exception('Stock insuficiente para ' . $producto->nombre);
                }
                $total += $detalles['precio'] * $detalles['cantidad'];
            }

            $compra = Compra::create([
                'user_id' => Auth::id(),
                'total' => $total,
                'estado' => 'pendiente',
                'direccion_envio' => Auth::user()->direccion ?? 'Sin dirección especificada'
            ]);

            foreach ($cart as $id => $detalles) {
                $producto = Producto::find($id);

                // Registrar detalle de compra
                $compra->productos()->attach($id, [
                    'cantidad' => $detalles['cantidad'],
                    'subtotal' => $detalles['cantidad'] * $detalles['precio']
                ]);

                // Actualizar stock
                $producto->cantidad_disponible -= $detalles['cantidad'];
                $producto->save();

                // Registrar en cardex
                Cardex::create([
                    'producto_id' => $id,
                    'tipo_movimiento' => 'venta',
                    'cantidad' => $detalles['cantidad'],
                    'saldo' => $producto->cantidad_disponible,
                    'fecha' => now()
                ]);
            }

            DB::commit();
            session()->forget('cart');
            return redirect()->route('usuarios.compras')->with('success', 'Compra realizada con éxito!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function actualizarCantidad(Request $request, $productoId)
    {
        $cart = session()->get('cart');

        if (isset($cart[$productoId])) {
            $producto = Producto::find($productoId);

            if ($producto && $request->cantidad <= $producto->cantidad_disponible) {
                $cart[$productoId]['cantidad'] = $request->cantidad;
                session()->put('cart', $cart);
                return response()->json(['success' => true]);
            }
        }

        return response()->json(['success' => false]);
    }
}
