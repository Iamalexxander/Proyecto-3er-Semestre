@extends('layouts.app2')

@section('content')
<div class="container">
    <div class="card border-0 rounded-3xl overflow-hidden shadow-lg"
         style="background: rgba(15, 23, 42, 0.8); backdrop-filter: blur(10px);">

        <!-- Header -->
        <div class="p-4" style="background: linear-gradient(45deg, var(--accent-color), var(--accent-color2));">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="text-white mb-0">
                    <i class="fas fa-receipt me-2"></i>
                    Detalles de la Compra #{{ str_pad($compra->id, 5, '0', STR_PAD_LEFT) }}
                </h2>
                @php
                    $statusColor = match($compra->estado) {
                        'completada' => 'success',
                        'pendiente' => 'warning',
                        'cancelada' => 'danger',
                        default => 'secondary'
                    };
                @endphp
                <span class="badge bg-{{ $statusColor }} bg-opacity-25 text-{{ $statusColor }} px-3 py-2 rounded-pill">
                    <i class="fas fa-circle me-1 small"></i>
                    {{ ucfirst($compra->estado) }}
                </span>
            </div>
        </div>

        <div class="p-4">
            <!-- Información General -->
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card bg-opacity-10 bg-white border-0">
                        <div class="card-body">
                            <h5 class="card-title text-white mb-4">
                                <i class="fas fa-info-circle me-2 text-warning"></i>
                                Información General
                            </h5>
                            <ul class="list-unstyled text-white-50">
                                <li class="mb-3">
                                    <strong class="text-white">Fecha:</strong>
                                    {{ $compra->created_at->format('d/m/Y H:i') }}
                                </li>
                                <li class="mb-3">
                                    <strong class="text-white">Dirección de envío:</strong><br>
                                    {{ $compra->direccion_envio }}
                                </li>
                                <li class="mb-3">
                                    <strong class="text-white">Total:</strong>
                                    <span class="text-warning">${{ number_format($compra->total, 2) }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Productos -->
                <div class="col-12 mt-4">
                    <h5 class="text-white mb-4">
                        <i class="fas fa-shopping-basket me-2 text-warning"></i>
                        Productos Comprados
                    </h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr class="text-white-50">
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio Unitario</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($compra->productos as $producto)
                                <tr class="text-white">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-box me-2 text-warning"></i>
                                            {{ $producto->nombre }}
                                        </div>
                                    </td>
                                    <td>{{ $producto->pivot->cantidad }}</td>
                                    <td>${{ number_format($producto->pivot->subtotal / $producto->pivot->cantidad, 2) }}</td>
                                    <td class="text-warning">${{ number_format($producto->pivot->subtotal, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="text-white">
                                    <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                    <td class="text-warning"><strong>${{ number_format($compra->total, 2) }}</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Botones de acción -->
            <div class="d-flex justify-content-end gap-3 mt-4">
                <a href="{{ route('usuarios.compras.index') }}"
                   class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>
                    Volver
                </a>
                <a href="{{ route('usuarios.compras.invoice', $compra) }}"
                   class="btn btn-warning">
                    <i class="fas fa-download me-2"></i>
                    Descargar Factura
                </a>
            </div>
        </div>
    </div>
</div>

<style>
.table {
    color: var(--text-color);
    margin-bottom: 0;
}

.table thead th {
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-size: 0.85rem;
    border-top: none;
}

.table tbody tr {
    background: rgba(255, 255, 255, 0.05);
    transition: all 0.3s ease;
}

.table tbody tr:hover {
    background: rgba(255, 255, 255, 0.1);
    transform: translateY(-2px);
}

.table td, .table th {
    border-color: rgba(255, 255, 255, 0.1);
    padding: 1rem;
    vertical-align: middle;
}

.badge {
    font-weight: 500;
    letter-spacing: 0.5px;
}

.btn {
    transition: all 0.3s ease;
    text-transform: none;
    letter-spacing: 0.5px;
    padding: 0.5rem 1.5rem;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
}

.card {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.list-unstyled li {
    padding: 0.5rem 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.list-unstyled li:last-child {
    border-bottom: none;
}
</style>
@endsection
