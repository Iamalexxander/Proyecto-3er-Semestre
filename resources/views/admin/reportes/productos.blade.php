@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="row">
        <div class="col-12">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-5">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle p-3 me-3 primary-gradient shadow-accent">
                        <i class="fas fa-box fa-2x text-white"></i>
                    </div>
                    <h1 class="text-white font-playfair mb-0">Reporte de Productos</h1>
                </div>
                <div>
                    <a href="{{ route('admin.reportes.index') }}" class="btn btn-report">
                        <i class="fas fa-arrow-left me-2"></i>
                        <span>Volver al Panel</span>
                    </a>
                </div>
            </div>

            <!-- Charts Row -->
            <div class="row mb-5">
                <div class="col-lg-8 mb-4">
                    <div class="chart-card">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fas fa-calendar-alt me-2"></i> Productos Añadidos por Día (Último Mes)</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="productosPorDia" height="300"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="chart-card h-100">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fas fa-tags me-2"></i> Estadísticas de Productos</h5>
                        </div>
                        <div class="card-body d-flex flex-column justify-content-center">
                            <div class="stat-item mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <p class="text-muted mb-0">Total de Productos</p>
                                    <h4 class="text-white mb-0">{{ count($productos) }}</h4>
                                </div>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar primary-gradient" role="progressbar" style="width: 100%"></div>
                                </div>
                            </div>
                            <div class="stat-item mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <p class="text-muted mb-0">Productos con Stock</p>
                                    <h4 class="text-white mb-0">{{ $productos->where('cantidad_disponible', '>', 0)->count() }}</h4>
                                </div>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar" role="progressbar" style="width: {{ ($productos->where('cantidad_disponible', '>', 0)->count() / count($productos)) * 100 }}%; background-color: rgba(75, 192, 192, 0.8);"></div>
                                </div>
                            </div>
                            <div class="stat-item">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <p class="text-muted mb-0">Productos sin Stock</p>
                                    <h4 class="text-white mb-0">{{ $productos->where('cantidad_disponible', '=', 0)->count() }}</h4>
                                </div>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar" role="progressbar" style="width: {{ ($productos->where('cantidad_disponible', '=', 0)->count() / count($productos)) * 100 }}%; background-color: rgba(255, 99, 132, 0.8);"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Table -->
            <div class="row">
                <div class="col-12">
                    <div class="chart-card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="fas fa-list me-2"></i> Lista de Productos</h5>
                            <div class="input-group search-container">
                                <span class="input-group-text bg-transparent border-0">
                                    <i class="fas fa-search text-muted"></i>
                                </span>
                                <input type="text" id="searchInput" class="form-control bg-transparent border-0 text-white" placeholder="Buscar producto...">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-borderless align-middle" id="productosTable">
                                    <thead>
                                        <tr>
                                            <th class="sortable" data-sort="nombre" style="color: black;">Producto <i class="fas fa-sort ms-1"></i></th>
                                            <th class="sortable" data-sort="categoria" style="color: black;">Categoría <i class="fas fa-sort ms-1"></i></th>
                                            <th class="sortable" data-sort="precio" style="color: black;">Precio <i class="fas fa-sort ms-1"></i></th>
                                            <th class="sortable" data-sort="stock" style="color: black;">Stock <i class="fas fa-sort ms-1"></i></th>
                                            <th class="sortable" data-sort="vendido" style="color: black;">Vendidos <i class="fas fa-sort ms-1"></i></th>
                                            <th class="sortable" data-sort="fecha" style="color: black;">Fecha de Creación <i class="fas fa-sort ms-1"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($productos as $producto)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="product-img me-3">
                                                        @if($producto->imagen)
                                                        <img src="{{ asset($producto->imagen) }}" alt="{{ $producto->nombre }}" class="img-fluid">
                                                    @else
                                                        <div class="no-img primary-gradient">
                                                            <i class="fas fa-box text-white"></i>
                                                        </div>
                                                    @endif
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0 text-black" >{{ $producto->nombre }}</h6>
                                                        <small class="text-muted">ID: {{ $producto->id }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="category-badge">{{ $producto->categoria->nombre }}</span>
                                            </td>
                                            <td>${{ number_format($producto->precio, 2) }}</td>
                                            <td>
                                                @if($producto->cantidad_disponible > 10)
                                                    <span class="stock-badge stock-high">{{ $producto->cantidad_disponible }}</span>
                                                @elseif($producto->cantidad_disponible > 0)
                                                    <span class="stock-badge stock-medium">{{ $producto->cantidad_disponible }}</span>
                                                @else
                                                    <span class="stock-badge stock-none">Agotado</span>
                                                @endif
                                            </td>
                                            <td>{{ $producto->veces_vendido ?: 0 }}</td>
                                            <td>{{ $producto->created_at->format('d/m/Y') }}</td>
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

.product-img {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}

.product-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.no-img {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.category-badge {
    display: inline-block;
    padding: 0.35rem 0.75rem;
    border-radius: 50px;
    font-size: 0.75rem;
    font-weight: 500;
    background: rgba(245, 158, 11, 0.15);
    color: var(--accent-color);
    border: 1px solid rgba(245, 158, 11, 0.2);
}

.stock-badge {
    display: inline-block;
    padding: 0.35rem 0.75rem;
    border-radius: 50px;
    font-size: 0.75rem;
    font-weight: 500;
}

.stock-high {
    background: rgba(75, 192, 192, 0.15);
    color: rgba(75, 192, 192, 1);
    border: 1px solid rgba(75, 192, 192, 0.2);
}

.stock-medium {
    background: rgba(255, 205, 86, 0.15);
    color: rgba(255, 205, 86, 1);
    border: 1px solid rgba(255, 205, 86, 0.2);
}

.stock-none {
    background: rgba(255, 99, 132, 0.15);
    color: rgba(255, 99, 132, 1);
    border: 1px solid rgba(255, 99, 132, 0.2);
}

.stat-item .progress {
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 10px;
    overflow: hidden;
}

.stat-item .progress-bar {
    border-radius: 10px;
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
    
    // Productos por día - Gráfico de Línea
    const fechasProductos = @json($fechasProductos);
    const cantidadesProductos = @json($cantidadesProductos);
    
    new Chart(document.getElementById('productosPorDia'), {
        type: 'line',
        data: {
            labels: fechasProductos,
            datasets: [{
                label: 'Productos Añadidos',
                data: cantidadesProductos,
                backgroundColor: 'rgba(255, 159, 64, 0.2)',
                borderColor: 'rgba(255, 159, 64, 1)',
                borderWidth: 3,
                tension: 0.4,
                fill: true,
                pointBackgroundColor: 'rgba(255, 159, 64, 1)',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 8
            }]
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
                        stepSize: 1
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
                    borderWidth: 1
                }
            }
        }
    });
    
    // Funcionalidad de búsqueda
    const searchInput = document.getElementById('searchInput');
    const productosTable = document.getElementById('productosTable');
    const rows = productosTable.querySelectorAll('tbody tr');
    
    searchInput.addEventListener('keyup', function(e) {
        const term = e.target.value.toLowerCase();
        
        rows.forEach(row => {
            const productName = row.querySelector('h6').textContent.toLowerCase();
            const categoryName = row.querySelector('.category-badge').textContent.toLowerCase();
            
            if (productName.includes(term) || categoryName.includes(term)) {
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
            const rows = Array.from(productosTable.querySelectorAll('tbody tr'));
            
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
                
                if (sort === 'nombre') {
                    valueA = a.querySelector('h6').textContent.trim();
                    valueB = b.querySelector('h6').textContent.trim();
                } else if (sort === 'categoria') {
                    valueA = a.querySelector('.category-badge').textContent.trim();
                    valueB = b.querySelector('.category-badge').textContent.trim();
                } else if (sort === 'precio') {
                    valueA = parseFloat(a.cells[2].textContent.replace('$', '').replace(',', ''));
                    valueB = parseFloat(b.cells[2].textContent.replace('$', '').replace(',', ''));
                } else if (sort === 'stock') {
                    const stockA = a.querySelector('.stock-badge').textContent.trim();
                    const stockB = b.querySelector('.stock-badge').textContent.trim();
                    valueA = stockA === 'Agotado' ? 0 : parseInt(stockA);
                    valueB = stockB === 'Agotado' ? 0 : parseInt(stockB);
                } else if (sort === 'vendido') {
                    valueA = parseInt(a.cells[4].textContent.trim());
                    valueB = parseInt(b.cells[4].textContent.trim());
                } else if (sort === 'fecha') {
                    const dateA = a.cells[5].textContent.split('/');
                    const dateB = b.cells[5].textContent.split('/');
                    valueA = new Date(dateA[2], dateA[1] - 1, dateA[0]);
                    valueB = new Date(dateB[2], dateB[1] - 1, dateB[0]);
                }
                
                if (currentDirection === 'asc') {
                    return valueA > valueB ? 1 : -1;
                } else {
                    return valueA < valueB ? 1 : -1;
                }
            });
            
            // Reordenar el DOM
            const tbody = productosTable.querySelector('tbody');
            rows.forEach(row => tbody.appendChild(row));
        });
    });
});
</script>
@endsection