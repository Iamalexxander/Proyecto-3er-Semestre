@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="row">
        <div class="col-12">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-5">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle p-3 me-3 primary-gradient shadow-accent">
                        <i class="fas fa-chart-bar fa-2x text-white"></i>
                    </div>
                    <h1 class="text-white font-playfair mb-0">Panel de Reportes</h1>
                </div>
                <div class="report-actions">
                    <a href="{{ route('admin.reportes.productos') }}" class="btn btn-report me-2">
                        <i class="fas fa-box me-2"></i>
                        <span>Reporte de Productos</span>
                    </a>
                    <a href="{{ route('admin.reportes.usuarios') }}" class="btn btn-report me-2">
                        <i class="fas fa-users me-2"></i>
                        <span>Reporte de Usuarios</span>
                    </a>
                    <a href="{{ route('admin.reportes.ventas') }}" class="btn btn-report" style="margin-top: 0.5cm;">
                        <i class="fas fa-shopping-cart me-2"></i>
                        <span>Reporte de Ventas</span>
                    </a>                    
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="row mb-5">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p style="color: white; text-align: center;">Total Productos</p>
                                    <h2 class="text-white mb-0 fw-bold text-center d-flex justify-content-center">{{ $totalProductos }}</h2>
                                </div>
                                <div class="icon-container primary-gradient shadow-accent">
                                    <i class="fas fa-box fa-lg text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p style="color: white; text-align: center;">Total Usuarios</p>
                                    <h2 class="text-white mb-0 fw-bold text-center d-flex justify-content-center">{{ $totalUsuarios }}</h2>
                                </div>
                                <div class="icon-container primary-gradient shadow-accent">
                                    <i class="fas fa-users fa-lg text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p style="color: white; text-align: center;">Total Ventas</p>
                                    <h2 class="text-white mb-0 fw-bold text-center d-flex justify-content-center">{{ $totalVentas }}</h2>
                                </div>
                                <div class="icon-container primary-gradient shadow-accent">
                                    <i class="fas fa-shopping-cart fa-lg text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p style="color: white; text-align: center;">Ingresos Totales</p>
                                    <h2 class="text-white mb-0 fw-bold text-center d-flex justify-content-center" >${{ number_format($ingresoTotal, 2) }}</h2>
                                </div>
                                <div class="icon-container primary-gradient shadow-accent">
                                    <i class="fas fa-dollar-sign fa-lg text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Row 1 -->
            <div class="row mb-5">
                <div class="col-xl-6 col-lg-12 mb-4">
                    <div class="chart-card">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fas fa-chart-bar me-2"></i> Productos por Categoría</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="productosPorCategoria" height="280"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-12 mb-4">
                    <div class="chart-card">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fas fa-chart-line me-2"></i> Ventas por Mes</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="ventasPorMes" height="280"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Row 2 -->
            <div class="row">
                <div class="col-xl-7 col-lg-12 mb-4">
                    <div class="chart-card">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fas fa-trophy me-2"></i> Productos Más Vendidos</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="productosMasVendidos" height="320"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-12 mb-4">
                    <div class="chart-card">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fas fa-user-plus me-2"></i> Nuevos Usuarios por Mes</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="usuariosPorMes" height="320"></canvas>
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

canvas {
    max-width: 100%;
}

@media (max-width: 992px) {
    .d-flex.justify-content-between {
        flex-direction: column;
        align-items: flex-start !important;
    }
    
    .report-actions {
        margin-top: 1.5rem;
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        width: 100%;
    }
    
    .btn-report {
        flex: 1;
        min-width: 200px;
        text-align: center;
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
    
    // Paleta de colores para los gráficos
    const colors = [
        'rgba(255, 159, 64, 0.8)',
        'rgba(255, 205, 86, 0.8)',
        'rgba(75, 192, 192, 0.8)',
        'rgba(54, 162, 235, 0.8)',
        'rgba(153, 102, 255, 0.8)',
        'rgba(201, 203, 207, 0.8)',
        'rgba(255, 99, 132, 0.8)'
    ];
    
    const borderColors = [
        'rgba(255, 159, 64, 1)',
        'rgba(255, 205, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(54, 162, 235, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(201, 203, 207, 1)',
        'rgba(255, 99, 132, 1)'
    ];
    
    // Productos por Categoría - Gráfico de Dona
    const categoriaLabels = @json($categoriaLabels);
    const categoriaData = @json($categoriaData);
    
    new Chart(document.getElementById('productosPorCategoria'), {
        type: 'doughnut',
        data: {
            labels: categoriaLabels,
            datasets: [{
                data: categoriaData,
                backgroundColor: colors,
                borderColor: borderColors,
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
    
    // Ventas por Mes - Gráfico de Línea
    const mesesLabels = @json($mesesLabels);
    const ventasData = @json($ventasData);
    
    new Chart(document.getElementById('ventasPorMes'), {
        type: 'line',
        data: {
            labels: mesesLabels,
            datasets: [{
                label: 'Ventas ($)',
                data: ventasData,
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
                        padding: 10
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
                        padding: 10
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
    
    // Productos Más Vendidos - Gráfico de Barras
    const productosMasVendidos = @json($productosMasVendidos);
    const productosLabels = productosMasVendidos.map(item => item.nombre);
    const productosData = productosMasVendidos.map(item => item.total_vendido);
    
    new Chart(document.getElementById('productosMasVendidos'), {
        type: 'bar',
        data: {
            labels: productosLabels,
            datasets: [{
                label: 'Unidades Vendidas',
                data: productosData,
                backgroundColor: colors,
                borderColor: 'rgba(30, 41, 59, 0.8)',
                borderWidth: 2,
                borderRadius: 6,
                maxBarThickness: 25
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)',
                        drawBorder: false
                    },
                    ticks: {
                        font: {
                            size: 12
                        },
                        padding: 10
                    }
                },
                y: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            size: 12
                        },
                        padding: 10
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
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
    
    // Usuarios por Mes - Gráfico de Barras
    const usuariosLabels = @json($usuariosLabels);
    const usuariosData = @json($usuariosData);
    
    new Chart(document.getElementById('usuariosPorMes'), {
        type: 'bar',
        data: {
            labels: usuariosLabels,
            datasets: [{
                label: 'Nuevos Usuarios',
                data: usuariosData,
                backgroundColor: 'rgba(75, 192, 192, 0.8)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2,
                borderRadius: 6,
                maxBarThickness: 35
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
                        padding: 10
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            size: 12
                        },
                        padding: 10
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
});
</script>
@endsection