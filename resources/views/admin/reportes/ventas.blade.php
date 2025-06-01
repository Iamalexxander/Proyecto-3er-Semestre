@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="row">
        <div class="col-12">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-5">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle p-3 me-3 primary-gradient shadow-accent">
                        <i class="fas fa-shopping-cart fa-2x text-white"></i>
                    </div>
                    <h1 class="text-white font-playfair mb-0">Reporte de Ventas</h1>
                </div>
                <div>
                    <a href="{{ route('admin.reportes.index') }}" class="btn btn-report">
                        <i class="fas fa-arrow-left me-2"></i>
                        <span>Volver al Panel</span>
                    </a>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="row mb-5">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="stat-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="text-muted mb-1">Total Ventas</p>
                                    <h2 class="text-white mb-0 fw-bold">{{ count($compras) }}</h2>
                                </div>
                                <div class="icon-container primary-gradient shadow-accent">
                                    <i class="fas fa-shopping-cart fa-lg text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="stat-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="text-muted mb-1">Ingresos Totales</p>
                                    <h2 class="text-white mb-0 fw-bold">${{ number_format($compras->sum('total'), 2) }}</h2>
                                </div>
                                <div class="icon-container primary-gradient shadow-accent">
                                    <i class="fas fa-dollar-sign fa-lg text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="stat-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="text-muted mb-1">Promedio por Venta</p>
                                    <h2 class="text-white mb-0 fw-bold">${{ number_format($compras->avg('total'), 2) }}</h2>
                                </div>
                                <div class="icon-container primary-gradient shadow-accent">
                                    <i class="fas fa-chart-line fa-lg text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="stat-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="text-muted mb-1">Clientes Únicos</p>
                                    <h2 class="text-white mb-0 fw-bold">{{ $compras->pluck('user_id')->unique()->count() }}</h2>
                                </div>
                                <div class="icon-container primary-gradient shadow-accent">
                                    <i class="fas fa-users fa-lg text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Row -->
            <div class="row mb-5">
                <div class="col-lg-12 mb-4">
                    <div class="chart-card">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fas fa-chart-line me-2"></i> Ventas por Día (Último Mes)</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="ventasPorDia" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ventas Table -->
            <div class="row">
                <div class="col-12">
                    <div class="chart-card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="fas fa-list me-2"></i> Registro de Ventas</h5>
                            <div class="input-group search-container">
                                <span class="input-group-text bg-transparent border-0">
                                    <i class="fas fa-search text-muted"></i>
                                </span>
                                <input type="text" id="searchInput" class="form-control bg-transparent border-0 text-white" placeholder="Buscar venta...">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-borderless align-middle" id="ventasTable">
                                    <thead>
                                        <tr>
                                            <th class="sortable" data-sort="id" style="color: black;">ID <i class="fas fa-sort ms-1"></i></th>
                                            <th class="sortable" data-sort="cliente" style="color: black;">Cliente <i class="fas fa-sort ms-1"></i></th>
                                            <th class="sortable" data-sort="productos" style="color: black;">Productos <i class="fas fa-sort ms-1"></i></th>
                                            <th class="sortable" data-sort="total" style="color: black;">Total <i class="fas fa-sort ms-1"></i></th>
                                            <th class="sortable" data-sort="estado" style="color: black;">Estado <i class="fas fa-sort ms-1"></i></th>
                                            <th class="sortable" data-sort="fecha" style="color: black;">Fecha <i class="fas fa-sort ms-1"></i></th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($compras as $compra)
                                        <tr data-id="{{ $compra->id }}">
                                            <td># {{ $compra->id }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="user-avatar me-3 primary-gradient">
                                                        {{ strtoupper(substr($compra->usuario->nombre_usuario ?? 'U', 0, 1)) }}
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0 text-white">{{ $compra->usuario->nombre_usuario ?? 'Usuario Eliminado' }}</h6>
                                                        <small class="text-muted">{{ $compra->usuario->email ?? 'Sin email' }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="product-count">{{ $compra->productos->count() }} productos</span>
                                            </td>
                                            <td><span class="fw-bold">${{ number_format($compra->total, 2) }}</span></td>
                                            <td>
                                                @if($compra->estado == 'completado')
                                                    <span class="status-badge status-completado">Completado</span>
                                                @elseif($compra->estado == 'pendiente')
                                                    <span class="status-badge status-pendiente">Pendiente</span>
                                                @elseif($compra->estado == 'cancelado')
                                                    <span class="status-badge status-cancelado">Cancelado</span>
                                                @else
                                                    <span class="status-badge status-procesando">{{ ucfirst($compra->estado) }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $compra->created_at->format('d/m/Y H:i') }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-details" data-bs-toggle="collapse" data-bs-target="#detalleVenta{{ $compra->id }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr class="collapse details-row" id="detalleVenta{{ $compra->id }}">
                                            <td colspan="7">
                                                <div class="p-3">
                                                    <h6 class="mb-3">Detalle de Venta #{{ $compra->id }}</h6>
                                                    <div class="mb-3">
                                                        <p class="mb-1"><strong>Dirección de Envío:</strong></p>
                                                        <p class="mb-0">{{ $compra->direccion_envio ?? 'No especificada' }}</p>
                                                    </div>
                                                    <div class="table-responsive">
                                                        <table class="table table-sm sub-table">
                                                            <thead>
                                                                <tr>
                                                                    <th style="color: black;">Producto</th>
                                                                    <th style="color: black;">Precio</th>
                                                                    <th style="color: black;">Cantidad</th>
                                                                    <th style="color: black;">Subtotal</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($compra->productos as $producto)
                                                                <tr>
                                                                    <td>{{ $producto->nombre }}</td>
                                                                    <td>${{ number_format($producto->pivot->subtotal / $producto->pivot->cantidad, 2) }}</td>
                                                                    <td>{{ $producto->pivot->cantidad }}</td>
                                                                    <td>${{ number_format($producto->pivot->subtotal, 2) }}</td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                                                    <td><strong>${{ number_format($compra->total, 2) }}</strong></td>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
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
    </div>
</div>

<style>
:root {
    --accent-color: rgba(245, 158, 11, 1);
    --accent-color2: rgba(217, 119, 6, 1);
    --card-bg: rgba(30, 41, 59, 0.9);
    --card-border: rgba(245, 158, 11, 0.2);
    --card-hover-shadow: rgba(245, 158, 11, 0.25);
    --dark-bg: rgba(15, 23, 42, 0.6);
    --status-completado: rgba(16, 185, 129, 0.8);
    --status-pendiente: rgba(59, 130, 246, 0.8);
    --status-cancelado: rgba(239, 68, 68, 0.8);
    --status-procesando: rgba(245, 158, 11, 0.8);
}

.primary-gradient {
    background: linear-gradient(45deg, var(--accent-color), var(--accent-color2));
}

.shadow-accent {
    box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
}

.font-playfair {
    font-family: 'Playfair Display', serif;
    font-weight: 600;
}

.btn-report {
    background: linear-gradient(45deg, var(--accent-color), var(--accent-color2));
    color: white;
    border: none;
    padding: 0.75rem 1.75rem;
    border-radius: 50px;
    transition: all 0.3s ease;
    font-weight: 500;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
}

.btn-report:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 18px rgba(245, 158, 11, 0.35);
    color: white;
}

.stat-card {
    background: var(--card-bg);
    backdrop-filter: blur(15px);
    border: 1px solid var(--card-border);
    border-radius: 15px;
    overflow: hidden;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    height: 100%;
}

.stat-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 25px var(--card-hover-shadow);
    border-color: var(--accent-color);
}

.icon-container {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.chart-card {
    background: var(--card-bg);
    backdrop-filter: blur(15px);
    border: 1px solid var(--card-border);
    border-radius: 15px;
    overflow: hidden;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    height: 100%;
}

.chart-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 25px var(--card-hover-shadow);
    border-color: var(--accent-color);
}

.chart-card .card-header {
    background: var(--dark-bg);
    border-bottom: 1px solid var(--card-border);
    padding: 1.25rem 1.5rem;
    color: white;
}

.chart-card .card-body {
    padding: 1.5rem;
}

.search-container {
    max-width: 300px;
    border-radius: 50px;
    overflow: hidden;
    background-color: rgba(30, 41, 59, 0.5);
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
}

.search-container:focus-within {
    border-color: var(--accent-color);
    box-shadow: 0 0 0 2px rgba(245, 158, 11, 0.25);
}

.search-container input::placeholder {
    color: rgba(255, 255, 255, 0.5);
}

.table {
    color: white;
}

.table thead th {
    border-top: none;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    color: rgba(255, 255, 255, 0.7);
    font-weight: 500;
    padding: 1rem 1rem;
    cursor: pointer;
}

.table tbody td {
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    padding: 1rem 1rem;
    vertical-align: middle;
}

.table tbody tr:hover {
    background-color: rgba(255, 255, 255, 0.05);
}

.table tbody tr:last-child td {
    border-bottom: none;
}

.user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 600;
    font-size: 16px;
}

.product-count {
    display: inline-block;
    padding: 0.35rem 0.75rem;
    border-radius: 50px;
    font-size: 0.75rem;
    font-weight: 500;
    background: rgba(255, 159, 64, 0.15);
    color: rgba(255, 159, 64, 1);
    border: 1px solid rgba(255, 159, 64, 0.2);
}

.status-badge {
    display: inline-block;
    padding: 0.35rem 0.75rem;
    border-radius: 50px;
    font-size: 0.75rem;
    font-weight: 500;
}

.status-badge.status-completado {
    background: rgba(16, 185, 129, 0.15);
    color: var(--status-completado);
    border: 1px solid rgba(16, 185, 129, 0.2);
}

.status-badge.status-pendiente {
    background: rgba(59, 130, 246, 0.15);
    color: var(--status-pendiente);
    border: 1px solid rgba(59, 130, 246, 0.2);
}

.status-badge.status-cancelado {
    background: rgba(239, 68, 68, 0.15);
    color: var(--status-cancelado);
    border: 1px solid rgba(239, 68, 68, 0.2);
}

.status-badge.status-procesando {
    background: rgba(245, 158, 11, 0.15);
    color: var(--status-procesando);
    border: 1px solid rgba(245, 158, 11, 0.2);
}

.btn-details {
    background-color: rgba(30, 41, 59, 0.5);
    color: white;
    border-radius: 50%;
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.btn-details:hover {
    background-color: var(--accent-color);
    color: white;
}

.details-row {
    background-color: rgba(15, 23, 42, 0.3);
}

.details-row td {
    padding: 0 !important;
}

.sub-table {
    margin-bottom: 0;
    font-size: 0.9rem;
    color: rgba(255, 255, 255, 0.8);
}

.sub-table th, .sub-table td {
    padding: 0.5rem 1rem;
    border-color: rgba(255, 255, 255, 0.05);
}

.sub-table thead th {
    color: rgba(255, 255, 255, 0.6);
    font-weight: 500;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.sortable {
    position: relative;
}

.sortable i {
    font-size: 0.7rem;
    opacity: 0.5;
    transition: all 0.3s ease;
}

.sortable:hover i {
    opacity: 1;
}

@media (max-width: 992px) {
    .d-flex.justify-content-between {
        flex-direction: column;
        align-items: flex-start !important;
    }
    
    .d-flex.justify-content-between > div:last-child {
        margin-top: 1rem;
        width: 100%;
    }
    
    .search-container {
        max-width: 100%;
        margin-top: 1rem;
    }
    
    .btn-report {
        width: 100%;
    }
}
</style>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Configuración global para Chart.js
    Chart.defaults.color = 'rgba(255, 255, 255, 0.8)';
    Chart.defaults.font.family = "'Poppins', sans-serif";
    
    // Ventas por día - Gráfico de Línea y barras
    const fechasVentas = @json($fechasVentas);
    const cantidadesVentas = @json($cantidadesVentas);
    
    new Chart(document.getElementById('ventasPorDia'), {
        type: 'bar',
        data: {
            labels: fechasVentas,
            datasets: [
                {
                    type: 'line',
                    label: 'Tendencia de Ventas',
                    data: cantidadesVentas,
                    backgroundColor: 'transparent',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 3,
                    tension: 0.4,
                    pointBackgroundColor: 'rgba(75, 192, 192, 1)',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 8
                },
                {
                    type: 'bar',
                    label: 'Ventas Diarias ($)',
                    data: cantidadesVentas,
                    backgroundColor: 'rgba(255, 159, 64, 0.7)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 2,
                    borderRadius: 6,
                    maxBarThickness: 30
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)',
                        drawBorder: false
                    },
                    ticks: {
                        font: {
                            size: 12
                        },
                        padding: 10,
                        callback: function(value) {
                            return '$' + value;
                        }
                    }
                },
                x: {
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)',
                        drawBorder: false
                    },
                    ticks: {
                        font: {
                            size: 12
                        },
                        padding: 10,
                        maxRotation: 45,
                        minRotation: 45
                    }
                }
            },
            plugins: {
                legend: {
                    labels: {
                        padding: 20,
                        usePointStyle: true,
                        pointStyle: 'circle',
                        font: {
                            size: 12
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(15, 23, 42, 0.9)',
                    titleFont: {
                        size: 14,
                        weight: 'bold'
                    },
                    bodyFont: {
                        size: 13
                    },
                    padding: 15,
                    cornerRadius: 8,
                    borderColor: 'rgba(245, 158, 11, 0.3)',
                    borderWidth: 1,
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': $' + context.parsed.y;
                        }
                    }
                }
            }
        }
    });
    
    // Funcionalidad de búsqueda
    const searchInput = document.getElementById('searchInput');
    const ventasTable = document.getElementById('ventasTable');
    const rows = ventasTable.querySelectorAll('tbody tr:not(.details-row)');
    const detailsRows = ventasTable.querySelectorAll('tbody tr.details-row');
    
    searchInput.addEventListener('keyup', function(e) {
        const term = e.target.value.toLowerCase();
        
        rows.forEach(row => {
            // Ocultar también las filas de detalles que pudieran estar abiertas
            const rowId = row.getAttribute('data-id');
            const detailsRow = document.getElementById('detalleVenta' + rowId);
            
            if (detailsRow) {
                detailsRow.classList.remove('show');
            }
            
            // Buscar en el ID, cliente y estado
            const ventaId = row.cells[0].textContent.toLowerCase();
            const clienteName = row.querySelector('h6')?.textContent.toLowerCase() || '';
            const status = row.querySelector('.status-badge')?.textContent.toLowerCase() || '';
            
            if (ventaId.includes(term) || clienteName.includes(term) || status.includes(term)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
    
    // Funcionalidad de ordenación
    const sortableColumns = document.querySelectorAll('.sortable');
    
    sortableColumns.forEach(column => {
        column.addEventListener('click', function() {
            const sort = this.getAttribute('data-sort');
            const rows = Array.from(ventasTable.querySelectorAll('tbody tr:not(.details-row)'));
            
            // Determinar la dirección de ordenación
            const currentDirection = this.classList.contains('asc') ? 'desc' : 'asc';
            
            // Limpiar clases de ordenación de todas las columnas
            sortableColumns.forEach(col => {
                col.classList.remove('asc', 'desc');
            });
            
            // Añadir clase de dirección actual
            this.classList.add(currentDirection);
            
            // Ordenar filas
            rows.sort((a, b) => {
                let valueA, valueB;
                
                if (sort === 'id') {
                    valueA = parseInt(a.cells[0].textContent.replace('#', '').trim());
                    valueB = parseInt(b.cells[0].textContent.replace('#', '').trim());
                } else if (sort === 'cliente') {
                    valueA = a.querySelector('h6')?.textContent.trim() || '';
                    valueB = b.querySelector('h6')?.textContent.trim() || '';
                } else if (sort === 'productos') {
                    valueA = parseInt(a.querySelector('.product-count').textContent.split(' ')[0]);
                    valueB = parseInt(b.querySelector('.product-count').textContent.split(' ')[0]);
                } else if (sort === 'total') {
                    valueA = parseFloat(a.cells[3].textContent.replace('$', '').replace(',', ''));
                    valueB = parseFloat(b.cells[3].textContent.replace('$', '').replace(',', ''));
                } else if (sort === 'estado') {
                    valueA = a.querySelector('.status-badge').textContent.trim();
                    valueB = b.querySelector('.status-badge').textContent.trim();
                } else if (sort === 'fecha') {
                    const dateA = a.cells[5].textContent.split(' ')[0].split('/');
                    const dateB = b.cells[5].textContent.split(' ')[0].split('/');
                    valueA = new Date(dateA[2], dateA[1] - 1, dateA[0]);
                    valueB = new Date(dateB[2], dateB[1] - 1, dateB[0]);
                }
                
                if (currentDirection === 'asc') {
                    return valueA > valueB ? 1 : -1;
                } else {
                    return valueA < valueB ? 1 : -1;
                }
            });
            
            // Reordenar el DOM manteniendo las filas de detalle con sus padres
            const tbody = ventasTable.querySelector('tbody');
            
            // Primero, almacenar referencias a las filas de detalle
            const detailsMap = {};
            detailsRows.forEach(row => {
                const id = row.id.replace('detalleVenta', '');
                detailsMap[id] = row;
            });
            
            // Limpiar la tabla
            tbody.innerHTML = '';
            
            // Añadir las filas ordenadas junto con sus detalles
            rows.forEach(row => {
                const rowId = row.getAttribute('data-id');
                tbody.appendChild(row);
                
                if (detailsMap[rowId]) {
                    tbody.appendChild(detailsMap[rowId]);
                }
            });
        });
    });
});
</script>
@endsection