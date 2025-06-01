@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle p-3 me-3" style="background: var(--accent-color)">
                        <i class="fas fa-warehouse fa-2x text-white"></i>
                    </div>
                    <h2 class="text-white font-playfair mb-0">Control de Inventario (Cardex)</h2>
                </div>
                <a href="{{ route('admin.cardex.create') }}" class="btn btn-action">
                    <i class="fas fa-plus-circle me-2"></i>
                    <span>Nuevo Movimiento</span>
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
                                                <i class="fas fa-calendar"></i>
                                            </span>
                                            Fecha
                                        </div>
                                    </th>
                                    <th class="px-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <span class="icon-wrapper me-2">
                                                <i class="fas fa-box"></i>
                                            </span>
                                            Producto
                                        </div>
                                    </th>
                                    <th class="px-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <span class="icon-wrapper me-2">
                                                <i class="fas fa-exchange-alt"></i>
                                            </span>
                                            Tipo
                                        </div>
                                    </th>
                                    <th class="px-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <span class="icon-wrapper me-2">
                                                <i class="fas fa-sort-numeric-up"></i>
                                            </span>
                                            Cantidad
                                        </div>
                                    </th>
                                    <th class="px-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <span class="icon-wrapper me-2">
                                                <i class="fas fa-cubes"></i>
                                            </span>
                                            Saldo
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
                                @foreach($cardex as $movimiento)
                                <tr class="text-white border-bottom" style="border-color: rgba(245, 158, 11, 0.2) !important;">
                                    <td class="px-4 py-3">{{ $movimiento->fecha }}</td>
                                    <td class="px-4 py-3">
                                        <span class="badge" style="background: var(--accent-color)">
                                            {{ $movimiento->producto->nombre }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="badge {{ $movimiento->tipo_movimiento == 'compra' ? 'bg-success' : 'bg-warning' }}">
                                            <i class="fas {{ $movimiento->tipo_movimiento == 'compra' ? 'fa-arrow-up' : 'fa-arrow-down' }} me-1"></i>
                                            {{ ucfirst($movimiento->tipo_movimiento) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="badge bg-info">
                                            {{ number_format($movimiento->cantidad) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="badge bg-secondary">
                                            {{ number_format($movimiento->saldo) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <div class="btn-group">
                                            <a href="{{ route('admin.cardex.edit', $movimiento->id) }}"
                                               class="btn btn-sm btn-action">
                                                <i class="fas fa-edit me-1"></i>
                                                Editar
                                            </a>
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
    padding: 0.5rem 1.5rem;
    border-radius: 0.5rem;
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
