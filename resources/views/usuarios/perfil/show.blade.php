@extends('layouts.app2')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <!-- Tarjeta Principal del Perfil -->
            <div class="card border-0 rounded-3xl overflow-hidden shadow-lg"
                 style="background: rgba(15, 23, 42, 0.8); backdrop-filter: blur(10px);">

                <!-- Banner y Foto de Perfil -->
                <div class="position-relative" style="height: 240px;">
                    <!-- Banner con gradiente -->
                    <div class="w-100 h-100" style="
                        background: linear-gradient(45deg, var(--accent-color), var(--accent-color2));
                        position: relative;
                        overflow: hidden;">
                        <!-- Efecto de patrón -->
                        <div class="position-absolute w-100 h-100" style="
                            background-image: radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                                            radial-gradient(circle at 80% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
                        "></div>
                    </div>

                    <!-- Foto de perfil -->
                    <div class="position-absolute" style="bottom: -50px; left: 50%; transform: translateX(-50%);">
                        <div class="d-flex flex-column align-items-center">
                            <div class="rounded-circle border-4 border-white shadow-lg d-flex align-items-center justify-content-center"
                                 style="width: 120px; height: 120px; background: linear-gradient(45deg, var(--accent-color), var(--accent-color2)); font-size: 3rem; color: white; border: 4px solid white;">
                                {{ strtoupper(substr(auth()->user()->nombre_usuario, 0, 1)) }}
                            </div>
                        </div>
                    </div>

                    <!-- Botón Editar -->
                    <div class="position-absolute top-0 end-0 m-4">
                        <a href="{{ route('usuarios.perfil.edit') }}"
                           class="btn btn-light d-flex align-items-center gap-2">
                            <i class="fas fa-edit"></i>
                            <span>Editar Perfil</span>
                        </a>
                    </div>
                </div>

                <!-- Información de Usuario -->
                <div class="text-center mt-5 pt-4">
                    <h1 class="display-6 fw-bold text-white mb-2">
                        {{ $usuario->nombre_usuario }}
                    </h1>
                    <div class="d-flex justify-content-center gap-4 text-white-50">
                        <span class="d-flex align-items-center">
                            <i class="fas fa-envelope me-2 text-warning"></i>
                            {{ $usuario->email }}
                        </span>
                        <span class="d-flex align-items-center">
                            <i class="fas fa-map-marker-alt me-2 text-warning"></i>
                            {{ $usuario->direccion ?? 'No especificada' }}
                        </span>
                    </div>
                </div>

                <div class="p-4 mt-4">
                    @if(session('success'))
                        <div class="alert alert-success d-flex align-items-center" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Grid de Información -->
                    <div class="row g-4 mt-2">
                        <!-- Estadísticas -->
                        <div class="col-md-4">
                            <div class="card h-100 border-0 rounded-3xl"
                                 style="background: rgba(255, 255, 255, 0.1);">
                                <div class="card-body">
                                    <h3 class="card-title text-white mb-4">
                                        <i class="fas fa-chart-line me-2 text-warning"></i>
                                        Estadísticas
                                    </h3>
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="text-white-50">Total Compras</span>
                                        <span class="h4 mb-0 text-warning">{{ $usuario->compras_count ?? 0 }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-white-50">Último Acceso</span>
                                        <span class="text-white">{{ $usuario->last_login ?? 'N/A' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Información de Contacto -->
                        <div class="col-md-8">
                            <div class="card h-100 border-0 rounded-3xl"
                                 style="background: rgba(255, 255, 255, 0.1);">
                                <div class="card-body">
                                    <h3 class="card-title text-white mb-4">
                                        <i class="fas fa-address-card me-2 text-warning"></i>
                                        Información de Contacto
                                    </h3>
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <div class="p-3 rounded-3xl" style="background: rgba(255, 255, 255, 0.05);">
                                                <div class="d-flex align-items-center">
                                                    <div class="rounded-circle p-3 me-3" style="background: rgba(245, 158, 11, 0.1);">
                                                        <i class="fas fa-phone text-warning"></i>
                                                    </div>
                                                    <div>
                                                        <div class="text-white-50 small">Teléfono</div>
                                                        <div class="text-white">{{ $usuario->telefono ?? 'No especificado' }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="p-3 rounded-3xl" style="background: rgba(255, 255, 255, 0.05);">
                                                <div class="d-flex align-items-center">
                                                    <div class="rounded-circle p-3 me-3" style="background: rgba(245, 158, 11, 0.1);">
                                                        <i class="fas fa-map-marker-alt text-warning"></i>
                                                    </div>
                                                    <div>
                                                        <div class="text-white-50 small">Dirección</div>
                                                        <div class="text-white">{{ $usuario->direccion ?? 'No especificada' }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Acciones Rápidas -->
                    <div class="d-flex flex-wrap justify-content-center gap-3 mt-5">
                        <a href="{{ route('usuarios.compras.index') }}" class="btn btn-primary d-flex align-items-center gap-2">
                            <i class="fas fa-shopping-bag"></i>
                            Mis Compras
                        </a>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.rounded-3xl {
    border-radius: 1.5rem;
}

.border-4 {
    border-width: 4px;
}

/* Animaciones */
.btn {
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
}

.card {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
}
</style>
@endsection
