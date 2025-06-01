<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with('categoria')->get();
        return view('admin.productos.index', compact('productos'));
    }

    public function create()
    {
        $categorias = Categoria::all();

        // Obtener todas las imágenes de la carpeta productos
        $imagenes = [];
        $directorio = public_path('images/productos');
        if (is_dir($directorio)) {
            $archivos = scandir($directorio);
            foreach ($archivos as $archivo) {
                if ($archivo != "." && $archivo != "..") {
                    $imagenes[] = 'images/productos/' . $archivo;
                }
            }
        }

        return view('admin.productos.create', compact('categorias', 'imagenes'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'cantidad_disponible' => 'required|integer|min:0',
            'categoria_id' => 'required|exists:categorias,id',
            'imagen' => 'required|string' // Cambiado a string ya que ahora es una ruta
        ]);

        Producto::create($validatedData);
        return redirect()->route('admin.productos.index')->with('success', 'Producto creado exitosamente');
    }

    public function show(Producto $producto)
    {
        return view('admin.productos.show', compact('producto')); // Corregido el path de la vista
    }

    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();

        // Obtener todas las imágenes de la carpeta productos
        $imagenes = [];
        $directorio = public_path('images/productos');
        if (is_dir($directorio)) {
            $archivos = scandir($directorio);
            foreach ($archivos as $archivo) {
                if ($archivo != "." && $archivo != "..") {
                    $imagenes[] = 'images/productos/' . $archivo;
                }
            }
        }

        return view('admin.productos.edit', compact('producto', 'categorias', 'imagenes'));
    }

    public function update(Request $request, Producto $producto)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric',
            'cantidad_disponible' => 'required|integer',
            'categoria_id' => 'required|exists:categorias,id',
            'imagen' => 'required|string' // Añadido la validación para la imagen
        ]);

        $producto->update($validated);
        return redirect()->route('admin.productos.index')
            ->with('success', 'Producto actualizado exitosamente.');
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('admin.productos.index')->with('success', 'Producto eliminado exitosamente.'); // Añadido prefijo 'admin.'
    }
}
