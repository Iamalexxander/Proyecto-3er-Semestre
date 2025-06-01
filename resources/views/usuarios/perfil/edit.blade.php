@extends('layouts.app2')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <!-- Tarjeta Principal de Edición -->
            <div class="card border-0 rounded-3xl overflow-hidden shadow-lg"
                 style="background: rgba(15, 23, 42, 0.8); backdrop-filter: blur(10px);">

                <!-- Cabecera con Gradiente -->
                <div class="position-relative" style="height: 120px;">
                    <div class="w-100 h-100" style="
                        background: linear-gradient(45deg, var(--accent-color), var(--accent-color2));
                        position: relative;
                        overflow: hidden;">
                        <div class="position-absolute w-100 h-100" style="
                            background-image: radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                                            radial-gradient(circle at 80% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
                        "></div>
                    </div>

                    <!-- Título de Edición -->
                    <div class="position-absolute w-100 h-100 d-flex align-items-center justify-content-center">
                        <h1 class="text-white mb-0 display-6 fw-bold">
                            <i class="fas fa-user-edit me-3"></i>Editar Perfil
                        </h1>
                    </div>
                </div>

                <div class="p-4">
                    @if(session('success'))
                        <div class="alert alert-success d-flex align-items-center" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Formularios -->
                    <div class="row g-4">
                        <!-- Formulario Principal -->
                        <div class="col-lg-8">
                            <div class="card h-100 border-0 rounded-3xl"
                                 style="background: rgba(255, 255, 255, 0.1);">
                                <div class="card-body p-4">
                                    <h4 class="card-title text-white mb-4">
                                        <i class="fas fa-info-circle me-2 text-warning"></i>
                                        Información Personal
                                    </h4>

                                    <form method="POST" action="{{ route('usuarios.perfil.update') }}" class="row g-4">
                                        @csrf
                                        @method('PUT')

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="text-white-50 mb-2">Nombre de Usuario</label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-transparent border-0 text-warning">
                                                        <i class="fas fa-user"></i>
                                                    </span>
                                                    <input type="text" name="nombre_usuario"
                                                           value="{{ old('nombre_usuario', $usuario->nombre_usuario) }}"
                                                           class="form-control bg-transparent text-white border-0 border-bottom"
                                                           style="border-radius: 0;">
                                                </div>
                                                @error('nombre_usuario')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="text-white-50 mb-2">Email</label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-transparent border-0 text-warning">
                                                        <i class="fas fa-envelope"></i>
                                                    </span>
                                                    <input type="email" name="email"
                                                           value="{{ old('email', $usuario->email) }}"
                                                           class="form-control bg-transparent text-white border-0 border-bottom"
                                                           style="border-radius: 0;">
                                                </div>
                                                @error('email')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="text-white-50 mb-2">Teléfono</label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-transparent border-0 text-warning">
                                                        <i class="fas fa-phone"></i>
                                                    </span>
                                                    <input type="text" name="telefono"
                                                           value="{{ old('telefono', $usuario->telefono) }}"
                                                           class="form-control bg-transparent text-white border-0 border-bottom"
                                                           style="border-radius: 0;">
                                                </div>
                                                @error('telefono')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="text-white-50 mb-2">Dirección</label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-transparent border-0 text-warning">
                                                        <i class="fas fa-map-marker-alt"></i>
                                                    </span>
                                                    <input type="text" name="direccion"
                                                           value="{{ old('direccion', $usuario->direccion) }}"
                                                           class="form-control bg-transparent text-white border-0 border-bottom"
                                                           style="border-radius: 0;">
                                                </div>
                                                @error('direccion')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12 mt-4">
                                            <button type="submit" class="btn btn-warning me-2">
                                                <i class="fas fa-save me-2"></i>Guardar Cambios
                                            </button>
                                            <a href="{{ route('usuarios.perfil') }}" class="btn btn-outline-light">
                                                <i class="fas fa-arrow-left me-2"></i>Volver
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Formulario de Contraseña -->
                        <div class="col-lg-4">
                            <div class="card h-100 border-0 rounded-3xl"
                                 style="background: rgba(255, 255, 255, 0.1);">
                                <div class="card-body p-4">
                                    <h3 class="card-title text-white mb-4">
                                        <i class="fas fa-lock me-2 text-warning"></i>
                                        Cambiar Contraseña
                                    </h3>

                                    <form method="POST" action="{{ route('usuarios.perfil.password') }}" class="row g-4">
                                        @csrf
                                        @method('PUT')

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="text-white-50 mb-2">Contraseña Actual</label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-transparent border-0 text-warning">
                                                        <i class="fas fa-key"></i>
                                                    </span>
                                                    <input type="password" name="current_password"
                                                           class="form-control bg-transparent text-white border-0 border-bottom"
                                                           style="border-radius: 0;">
                                                </div>
                                                @error('current_password')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="text-white-50 mb-2">Nueva Contraseña</label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-transparent border-0 text-warning">
                                                        <i class="fas fa-lock"></i>
                                                    </span>
                                                    <input type="password" name="password"
                                                           class="form-control bg-transparent text-white border-0 border-bottom"
                                                           style="border-radius: 0;">
                                                </div>
                                                @error('password')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="text-white-50 mb-2">Confirmar Nueva Contraseña</label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-transparent border-0 text-warning">
                                                        <i class="fas fa-lock"></i>
                                                    </span>
                                                    <input type="password" name="password_confirmation"
                                                           class="form-control bg-transparent text-white border-0 border-bottom"
                                                           style="border-radius: 0;">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 mt-4">
                                            <button type="submit" class="btn btn-warning w-100">
                                                <i class="fas fa-key me-2"></i>Actualizar Contraseña
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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

.form-control:focus {
    background-color: rgba(255, 255, 255, 0.1) !important;
    box-shadow: none !important;
    border-color: var(--accent-color) !important;
}

.input-group-text {
    min-width: 40px;
    justify-content: center;
}

.btn {
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
}
</style>
@endsection
