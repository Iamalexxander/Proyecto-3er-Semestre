<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Producto;
use App\Models\Usuario;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReporteController extends Controller
{
    public function index()
    {
        // Datos para productos por categoría
        $productosPorCategoria = Categoria::withCount('productos')->get();
        $categoriaLabels = $productosPorCategoria->pluck('nombre');
        $categoriaData = $productosPorCategoria->pluck('productos_count');
        
        // Datos para ventas por mes (últimos 6 meses)
        $ventasPorMes = Compra::selectRaw('MONTH(created_at) as mes, YEAR(created_at) as año, COUNT(*) as total_compras, SUM(total) as total_ventas')
            ->whereDate('created_at', '>=', Carbon::now()->subMonths(6))
            ->groupBy('año', 'mes')
            ->orderBy('año')
            ->orderBy('mes')
            ->get();
            
        $mesesLabels = [];
        $ventasData = [];
        
        foreach ($ventasPorMes as $venta) {
            $fecha = Carbon::createFromDate($venta->año, $venta->mes, 1);
            $mesesLabels[] = $fecha->format('M Y');
            $ventasData[] = $venta->total_ventas;
        }
        
        // Productos más vendidos
        $productosMasVendidos = DB::table('compra_producto')
            ->join('productos', 'compra_producto.producto_id', '=', 'productos.id')
            ->select('productos.nombre', DB::raw('SUM(compra_producto.cantidad) as total_vendido'))
            ->groupBy('productos.id', 'productos.nombre')
            ->orderByDesc('total_vendido')
            ->limit(5)
            ->get();
            
        // Usuarios registrados por mes
        $usuariosPorMes = Usuario::selectRaw('MONTH(created_at) as mes, YEAR(created_at) as año, COUNT(*) as total_usuarios')
            ->whereDate('created_at', '>=', Carbon::now()->subMonths(6))
            ->groupBy('año', 'mes')
            ->orderBy('año')
            ->orderBy('mes')
            ->get();
            
        $usuariosLabels = [];
        $usuariosData = [];
        
        foreach ($usuariosPorMes as $usuario) {
            $fecha = Carbon::createFromDate($usuario->año, $usuario->mes, 1);
            $usuariosLabels[] = $fecha->format('M Y');
            $usuariosData[] = $usuario->total_usuarios;
        }
        
        // Estadísticas generales
        $totalProductos = Producto::count();
        $totalUsuarios = Usuario::count();
        $totalVentas = Compra::count();
        $ingresoTotal = Compra::sum('total');
        
        return view('admin.reportes.index', compact(
            'categoriaLabels', 
            'categoriaData', 
            'mesesLabels', 
            'ventasData', 
            'productosMasVendidos',
            'usuariosLabels',
            'usuariosData',
            'totalProductos',
            'totalUsuarios',
            'totalVentas',
            'ingresoTotal'
        ));
    }
    
    public function productosReport()
    {
        $productos = Producto::with('categoria')
            ->withCount(['compras as veces_vendido' => function($query) {
                $query->select(DB::raw('SUM(cantidad)'));
            }])
            ->orderBy('created_at', 'desc')
            ->get();
            
        // Productos por fecha de creación (último mes)
        $productosPorDia = Producto::selectRaw('DATE(created_at) as fecha, COUNT(*) as total')
            ->whereDate('created_at', '>=', Carbon::now()->subMonth())
            ->groupBy('fecha')
            ->orderBy('fecha')
            ->get();
            
        $fechasProductos = $productosPorDia->pluck('fecha');
        $cantidadesProductos = $productosPorDia->pluck('total');
        
        return view('admin.reportes.productos', compact(
            'productos', 
            'fechasProductos', 
            'cantidadesProductos'
        ));
    }
    
    public function usuariosReport()
    {
        $usuarios = Usuario::with(['rol' => function($query) {
            $query->select('id', 'name as nombre');
        }])
        ->withCount('compras')
        ->orderBy('created_at', 'desc')
        ->get();
            
        // Usuarios por rol - Asegurarnos de usar el campo correcto
        $usuariosPorRol = DB::table('usuarios')
            ->join('roles', 'usuarios.rol_id', '=', 'roles.id')
            ->select('roles.name as nombre', DB::raw('COUNT(*) as total'))
            ->groupBy('roles.id', 'roles.name')
            ->get();
            
        $rolLabels = $usuariosPorRol->pluck('nombre');
        $rolData = $usuariosPorRol->pluck('total');
        
        return view('admin.reportes.usuarios', compact(
            'usuarios', 
            'rolLabels', 
            'rolData'
        ));
    }
    
    public function ventasReport()
    {
        $compras = Compra::with(['usuario', 'productos'])
            ->orderBy('created_at', 'desc')
            ->get();
            
        // Ventas por día (último mes)
        $ventasPorDia = Compra::selectRaw('DATE(created_at) as fecha, COUNT(*) as total_compras, SUM(total) as total_ventas')
            ->whereDate('created_at', '>=', Carbon::now()->subMonth())
            ->groupBy('fecha')
            ->orderBy('fecha')
            ->get();
            
        $fechasVentas = $ventasPorDia->pluck('fecha');
        $cantidadesVentas = $ventasPorDia->pluck('total_ventas');
        
        return view('admin.reportes.ventas', compact(
            'compras', 
            'fechasVentas', 
            'cantidadesVentas'
        ));
    }
}