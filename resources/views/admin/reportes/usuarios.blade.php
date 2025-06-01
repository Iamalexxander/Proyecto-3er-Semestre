@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="row">
        <div class="col-12">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-5">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle p-3 me-3 primary-gradient shadow-accent">
                        <i class="fas fa-users fa-2x text-white"></i>
                    </div>
                    <h1 class="text-white font-playfair mb-0">Reporte de Usuarios</h1>
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
                            <h5 class="mb-0"><i class="fas fa-users me-2"></i> Distribución de Usuarios por Rol</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="usuariosPorRol" height="300"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="chart-card h-100">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fas fa-user-check me-2"></i> Estadísticas de Usuarios</h5>
                        </div>
                        <div class="card-body d-flex flex-column justify-content-center">
                            <div class="stat-item mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <p class="text-muted mb-0">Total de Usuarios</p>
                                    <h4 class="text-white mb-0">{{ count($usuarios) }}</h4>
                                </div>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar primary-gradient" role="progressbar" style="width: 100%"></div>
                                </div>
                            </div>
                            <div class="stat-item mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <p class="text-muted mb-0">Usuarios con Compras</p>
                                    <h4 class="text-white mb-0">{{ $usuarios->where('compras_count', '>', 0)->count() }}</h4>
                                </div>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar" role="progressbar" style="width: {{ ($usuarios->where('compras_count', '>', 0)->count() / count($usuarios)) * 100 }}%; background-color: rgba(75, 192, 192, 0.8);"></div>
                                </div>
                            </div>
                            <div class="stat-item">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <p class="text-muted mb-0">Usuarios sin Compras</p>
                                    <h4 class="text-white mb-0">{{ $usuarios->where('compras_count', '=', 0)->count() }}</h4>
                                </div>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar" role="progressbar" style="width: {{ ($usuarios->where('compras_count', '=', 0)->count() / count($usuarios)) * 100 }}%; background-color: rgba(255, 99, 132, 0.8);"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Users Table -->
            <div class="row">
                <div class="col-12">
                    <div class="chart-card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="fas fa-list me-2"></i> Lista de Usuarios</h5>
                            <div class="input-group search-container">
                                <span class="input-group-text bg-transparent border-0">
                                    <i class="fas fa-search text-muted"></i>
                                </span>
                                <input type="text" id="searchInput" class="form-control bg-transparent border-0 text-white" placeholder="Buscar usuario...">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-borderless align-middle" id="usuariosTable">
                                    <thead>
                                        <tr>
                                            <th class="sortable" data-sort="nombre" style="color: black;">Usuario <i class="fas fa-sort ms-1"></i></th>
                                            <th class="sortable" data-sort="email" style="color: black;">Email <i class="fas fa-sort ms-1"></i></th>
                                            <th class="sortable" data-sort="rol" style="color: black;" >Rol <i class="fas fa-sort ms-1"></i></th>
                                            <th class="sortable" data-sort="compras" style="color: black;" >Compras <i class="fas fa-sort ms-1"></i></th>
                                            <th class="sortable" data-sort="telefono" style="color: black;">Teléfono <i class="fas fa-sort ms-1"></i></th>
                                            <th class="sortable" data-sort="fecha" style="color: black;">Fecha de Registro <i class="fas fa-sort ms-1"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($usuarios as $usuario)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="user-avatar me-3 primary-gradient">
                                                        {{ strtoupper(substr($usuario->nombre_usuario, 0, 1)) }}
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0 text-black">{{ $usuario->nombre_usuario }}</h6>
                                                        <small class="text-muted">ID: {{ $usuario->id }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $usuario->email }}</td>
                                            <td>
                                                <span class="role-badge {{ strtolower($usuario->rol->nombre) }}">{{ $usuario->rol->nombre }}</span>
                                            </td>
                                            <td>
                                                @if($usuario->compras_count > 0)
                                                    <span class="user-badge has-purchases">{{ $usuario->compras_count }}</span>
                                                @else
                                                    <span class="user-badge no-purchases">0</span>
                                                @endif
                                            </td>
                                            <td>{{ $usuario->telefono ?: 'No registrado' }}</td>
                                            <td>{{ $usuario->created_at->format('d/m/Y H:i') }}</td>
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
    --admin-color: rgba(239, 68, 68, 0.8);
    --cliente-color: rgba(59, 130, 246, 0.8);
    --empleado-color: rgba(16, 185, 129, 0.8);
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

.role-badge {
    display: inline-block;
    padding: 0.35rem 0.75rem;
    border-radius: 50px;
    font-size: 0.75rem;
    font-weight: 500;
}

.role-badge.admin {
    background: rgba(239, 68, 68, 0.15);
    color: var(--admin-color);
    border: 1px solid rgba(239, 68, 68, 0.2);
}

.role-badge.cliente {
    background: rgba(59, 130, 246, 0.15);
    color: var(--cliente-color);
    border: 1px solid rgba(59, 130, 246, 0.2);
}

.role-badge.empleado {
    background: rgba(16, 185, 129, 0.15);
    color: var(--empleado-color);
    border: 1px solid rgba(16, 185, 129, 0.2);
}

.user-badge {
    display: inline-block;
    padding: 0.35rem 0.75rem;
    border-radius: 50px;
    font-size: 0.75rem;
    font-weight: 500;
}

.user-badge.has-purchases {
    background: rgba(75, 192, 192, 0.15);
    color: rgba(75, 192, 192, 1);
    border: 1px solid rgba(75, 192, 192, 0.2);
}

.user-badge.no-purchases {
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
    
    // Colores para los roles
    const roleColors = {
        'admin': 'rgba(239, 68, 68, 0.8)',   
        'cliente': 'rgba(59, 130, 246, 0.8)', 
        'empleado': 'rgba(16, 185, 129, 0.8)',
        'default': 'rgba(255, 159, 64, 0.8)'
    };
    
    const roleBorders = {
        'admin': 'rgba(239, 68, 68, 1)',   
        'cliente': 'rgba(59, 130, 246, 1)', 
        'empleado': 'rgba(16, 185, 129, 1)',
        'default': 'rgba(255, 159, 64, 1)'
    };
    
    // Usuarios por Rol - Gráfico de Dona
    const rolLabels = @json($rolLabels);
    const rolData = @json($rolData);
    
    const backgroundColor = rolLabels.map(label => roleColors[label] || roleColors['default']);
    const borderColor = rolLabels.map(label => roleBorders[label] || roleBorders['default']);
    
    new Chart(document.getElementById('usuariosPorRol'), {
        type: 'doughnut',
        data: {
            labels: rolLabels,
            datasets: [{
                data: rolData,
                backgroundColor: backgroundColor,
                borderColor: borderColor,
                borderWidth: 2,
                hoverOffset: 15
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '60%',
            plugins: {
                legend: {
                    position: 'right',
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
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    });
    
    // Funcionalidad de búsqueda
    const searchInput = document.getElementById('searchInput');
    const usuariosTable = document.getElementById('usuariosTable');
    const rows = usuariosTable.querySelectorAll('tbody tr');
    
    searchInput.addEventListener('keyup', function(e) {
        const term = e.target.value.toLowerCase();
        
        rows.forEach(row => {
            const userName = row.querySelector('h6').textContent.toLowerCase();
            const userEmail = row.cells[1].textContent.toLowerCase();
            const userRole = row.querySelector('.role-badge').textContent.toLowerCase();
            
            if (userName.includes(term) || userEmail.includes(term) || userRole.includes(term)) {
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
            const rows = Array.from(usuariosTable.querySelectorAll('tbody tr'));
            
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
                } else if (sort === 'email') {
                    valueA = a.cells[1].textContent.trim();
                    valueB = b.cells[1].textContent.trim();
                } else if (sort === 'rol') {
                    valueA = a.querySelector('.role-badge').textContent.trim();
                    valueB = b.querySelector('.role-badge').textContent.trim();
                } else if (sort === 'compras') {
                    valueA = parseInt(a.querySelector('.user-badge').textContent.trim());
                    valueB = parseInt(b.querySelector('.user-badge').textContent.trim());
                } else if (sort === 'telefono') {
                    valueA = a.cells[4].textContent.trim();
                    valueB = b.cells[4].textContent.trim();
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
            
            // Reordenar el DOM
            const tbody = usuariosTable.querySelector('tbody');
            rows.forEach(row => tbody.appendChild(row));
        });
    });
});
</script>
@endsection