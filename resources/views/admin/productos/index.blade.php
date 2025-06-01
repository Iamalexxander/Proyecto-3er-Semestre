@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle p-3 me-3" style="background: var(--accent-color)">
                        <i class="fas fa-box fa-2x text-white"></i>
                    </div>
                    <h2 class="text-white font-playfair mb-0">Gestión de Productos</h2>
                </div>
                <a href="{{ route('admin.productos.create') }}" class="btn">
                    <i class="fas fa-plus-circle me-2"></i>
                    <span>Nuevo Producto</span>
                </a>
            </div>

            <!-- Table Card -->
            <div class="card border-0" style="background: rgba(30, 41, 59, 0.8); backdrop-filter: blur(10px); border: 1px solid rgba(245, 158, 11, 0.2);">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr class="text-white">
                                    <th class="px-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <span class="icon-wrapper me-2">
                                                <i class="fas fa-tag"></i>
                                            </span>
                                            Nombre
                                        </div>
                                    </th>
                                    <th class="px-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <span class="icon-wrapper me-2">
                                                <i class="fas fa-dollar-sign"></i>
                                            </span>
                                            Precio
                                        </div>
                                    </th>
                                    <th class="px-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <span class="icon-wrapper me-2">
                                                <i class="fas fa-cubes"></i>
                                            </span>
                                            Stock
                                        </div>
                                    </th>
                                    <th class="px-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <span class="icon-wrapper me-2">
                                                <i class="fas fa-folder"></i>
                                            </span>
                                            Categoría
                                        </div>
                                    </th>
                                    <th class="px-4 py-3 text-center">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <span class="icon-wrapper me-2">
                                                <i class="fas fa-cogs"></i>
                                            </span>
                                            Acciones
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($productos as $producto)
                                <tr class="text-white border-bottom" style="border-color: rgba(245, 158, 11, 0.2) !important;">
                                    <td class="px-4 py-3">{{ $producto->nombre }}</td>
                                    <td class="px-4 py-3">
                                        <span class="badge" style="background: var(--accent-color)">
                                            ${{ number_format($producto->precio, 2) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="badge {{ $producto->cantidad_disponible > 10 ? 'bg-success' : 'bg-warning' }}">
                                            <i class="fas {{ $producto->cantidad_disponible > 10 ? 'fa-check-circle' : 'fa-exclamation-circle' }} me-1"></i>
                                            {{ $producto->cantidad_disponible }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="badge" style="background: var(--accent-color2)">
                                            <i class="fas fa-tag me-1"></i>
                                            {{ $producto->categoria->nombre }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <div class="btn-group">
                                            <a href="{{ route('admin.productos.edit', $producto) }}"
                                               class="btn btn-sm btn-action">
                                                <i class="fas fa-edit me-1"></i>
                                                Editar
                                            </a>
                                            <form action="{{ route('admin.productos.destroy', $producto) }}"
                                                  method="POST"
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-sm btn-danger ms-2"
                                                        onclick="return confirm('¿Está seguro de eliminar este producto?')">
                                                    <i class="fas fa-trash-alt me-1"></i>
                                                    Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.table {
    color: var(--text-color);
}

.icon-wrapper {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 24px;
    height: 24px;
    background: var(--accent-color);
    border-radius: 50%;
}

.table tr {
    transition: all 0.3s ease;
}

.table tbody tr:hover {
    background: rgba(245, 158, 11, 0.1);
}

.badge {
    padding: 0.5rem 1rem;
    font-weight: 500;
    letter-spacing: 0.5px;
}

.btn-action {
    background: linear-gradient(45deg, var(--accent-color), var(--accent-color2));
    color: white;
    border: none;
    transition: all 0.3s ease;
}

.btn-action:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
    color: white;
}

.btn-group .btn {
    padding: 0.5rem 1rem;
}

@media (max-width: 768px) {
    .table-responsive {
        border-radius: 0.5rem;
    }

    .btn-group {
        flex-direction: column;
        gap: 0.5rem;
    }

    .btn-group .btn {
        width: 100%;
    }
}
</style>
@endsection
