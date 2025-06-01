<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class UsuarioProductoController extends Controller
{
    public function index(Request $request)
    {
        $query = Producto::with('categoria');

        // Filtro por categoría
        if ($request->categoria && $request->categoria !== '') {
            $query->where('categoria_id', $request->categoria);
        }

        // Búsqueda
        if ($request->buscar && trim($request->buscar) !== '') {
            $busqueda = '%' . trim($request->buscar) . '%';
            $query->where(function($q) use ($busqueda) {
                $q->where('nombre', 'like', $busqueda)
                  ->orWhere('descripcion', 'like', $busqueda);
            });
        }

        // Ordenamiento
        switch ($request->ordenar) {
            case 'precio_asc':
                $query->orderBy('precio', 'asc');
                break;
            case 'precio_desc':
                $query->orderBy('precio', 'desc');
                break;
            case 'nombre':
                $query->orderBy('nombre', 'asc');
                break;
            case 'reciente':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $productos = $query->paginate(12)->withQueryString();
        $categorias = Categoria::orderBy('nombre')->get();

        return view('usuarios.productos.index', [
            'productos' => $productos,
            'categorias' => $categorias,
            'selectedCategoria' => $request->categoria,
            'selectedOrden' => $request->ordenar ?? 'reciente',
            'searchTerm' => $request->buscar
        ]);
    }

    public function show(Producto $producto)
    {
        return view('usuarios.productos.show', compact('producto'));
    }

    public function create(Producto $producto)
    {
        return view('usuarios.productos.create', compact('producto'));
    }
}
