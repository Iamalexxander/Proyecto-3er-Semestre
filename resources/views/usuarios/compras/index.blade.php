@extends('layouts.app2')

@section('content')
<div class="container">
    <div class="card border-0 rounded-3xl overflow-hidden shadow-lg"
         style="background: rgba(15, 23, 42, 0.8); backdrop-filter: blur(10px);">

        <!-- Header con gradiente -->
        <div class="position-relative p-4"
             style="background: linear-gradient(45deg, var(--accent-color), var(--accent-color2));">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0 text-white display-6 fw-bold">
                    <i class="fas fa-shopping-bag me-3"></i>
                    Mis Compras
                </h2>
                <div class="position-relative">
                    <div class="p-2 rounded-circle"
                         style="background: rgba(255, 255, 255, 0.1);">
                        <i class="fas fa-receipt fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-4">
            @if($compras->isEmpty())
                <div class="text-center p-5">
                    <div class="mb-4">
                        <i class="fas fa-shopping-cart fa-4x text-warning opacity-50"></i>
                    </div>
                    <h3 class="text-white mb-3">No tienes compras realizadas</h3>
                    <p class="text-white-50 mb-4">¡Explora nuestra tienda y encuentra productos increíbles!</p>
                    <a href="{{ route('usuarios.productos.index') }}"
                       class="btn btn-warning btn-lg">
                        <i class="fas fa-store me-2"></i>
                        Ir a la Tienda
                    </a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr class="text-white-50">
                                <th class="border-0">Nº Orden</th>
                                <th class="border-0">Fecha</th>
                                <th class="border-0">Total</th>
                                <th class="border-0">Estado</th>
                                <th class="border-0">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($compras as $compra)
                            <tr class="text-white align-middle">
                                <td>
                                    <span class="fw-bold">#{{ str_pad($compra->id, 5, '0', STR_PAD_LEFT) }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-calendar-alt text-warning me-2"></i>
                                        {{ $compra->created_at->format('d/m/Y') }}
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-bold text-warning">
                                        ${{ number_format($compra->total, 2) }}
                                    </div>
                                </td>
                                <td>
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
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('usuarios.compras.show', $compra) }}"
                                           class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye me-1"></i>
                                            Detalles
                                        </a>
                                        <a href="{{ route('usuarios.compras.invoice', $compra) }}"
                                           class="btn btn-sm btn-secondary">
                                            <i class="fas fa-download me-1"></i>
                                            Factura
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $compras->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

<style>
/* Los estilos se mantienen igual */
.table {
    color: var(--text-color);
}

.table thead th {
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-size: 0.85rem;
}

.table tbody tr {
    transition: all 0.3s ease;
    background: rgba(255, 255, 255, 0.02);
}

.table tbody tr:hover {
    background: rgba(255, 255, 255, 0.05);
    transform: translateY(-2px);
}

.btn {
    transition: all 0.3s ease;
    text-transform: none;
    letter-spacing: 0.5px;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
}

.badge {
    font-weight: 500;
    letter-spacing: 0.5px;
}

.pagination {
    gap: 0.5rem;
}

.page-link {
    border-radius: 0.5rem;
    border: none;
    padding: 0.5rem 1rem;
    color: var(--text-color);
    background: rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
}

.page-link:hover {
    background: var(--accent-color);
    color: white;
    transform: translateY(-2px);
}

.page-item.active .page-link {
    background: var(--accent-color);
    color: white;
}

.rounded-3xl {
    border-radius: 1.5rem;
}
</style>
@endsection
