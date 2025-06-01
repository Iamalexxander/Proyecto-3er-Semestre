@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-2xl" style="background: rgba(15, 23, 42, 0.95); backdrop-filter: blur(20px);">
                <!-- Header -->
                <div class="card-header border-bottom border-accent p-4"
                     style="background: linear-gradient(45deg, var(--primary-color), var(--secondary-color))">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle p-3 me-3" style="background: var(--accent-color)">
                            <i class="fas fa-user-plus fa-2x text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-white mb-0">Crear Nuevo Usuario</h3>
                            <p class="text-white-50 mb-0">Registrar un nuevo usuario en el sistema</p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4 text-white">
                    <form action="{{ route('admin.clientes.store') }}" method="POST" class="needs-validation" id="createUserForm" novalidate>
                        @csrf

                        <div class="row g-4">
                            <!-- Nombre de Usuario -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre_usuario" class="form-label d-flex align-items-center">
                                        <span class="icon-wrapper me-2">
                                            <i class="fas fa-user"></i>
                                        </span>
                                        Nombre de Usuario
                                    </label>
                                    <input type="text"
                                           class="form-control form-control-lg bg-dark text-white border-accent @error('nombre_usuario') is-invalid @enderror"
                                           id="nombre_usuario"
                                           name="nombre_usuario"
                                           value="{{ old('nombre_usuario') }}"
                                           pattern="^[A-Za-z0-9]{5,12}$"
                                           title="Entre 5 y 12 caracteres, solo letras y números"
                                           required>
                                    @error('nombre_usuario')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="invalid-feedback">Usuario debe tener entre 5 y 12 caracteres (solo letras y números).</div>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="form-label d-flex align-items-center">
                                        <span class="icon-wrapper me-2">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                        Email
                                    </label>
                                    <input type="email"
                                           class="form-control form-control-lg bg-dark text-white border-accent @error('email') is-invalid @enderror"
                                           id="email"
                                           name="email"
                                           value="{{ old('email') }}"
                                           pattern="[a-z0-9._%+-]+@(gmail|hotmail|outlook|yahoo|icloud|protonmail|aol)\.(com|net|org|edu|es|co|ec)"
                                           title="Ingrese un correo válido (gmail, hotmail, etc.)"
                                           required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="invalid-feedback">Ingrese un correo electrónico válido.</div>
                                </div>
                            </div>

                            <!-- Teléfono -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="telefono" class="form-label d-flex align-items-center">
                                        <span class="icon-wrapper me-2">
                                            <i class="fas fa-phone"></i>
                                        </span>
                                        Teléfono
                                    </label>
                                    <input type="text"
                                           class="form-control form-control-lg bg-dark text-white border-accent @error('telefono') is-invalid @enderror"
                                           id="telefono"
                                           name="telefono"
                                           value="{{ old('telefono') }}"
                                           pattern="^09\d{8}$"
                                           title="Debe comenzar con 09 y tener 10 dígitos"
                                           required>
                                    @error('telefono')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="invalid-feedback">El teléfono debe comenzar con 09 y tener 10 dígitos.</div>
                                </div>
                            </div>

                            <!-- Dirección -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="direccion" class="form-label d-flex align-items-center">
                                        <span class="icon-wrapper me-2">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </span>
                                        Dirección
                                    </label>
                                    <input type="text"
                                           class="form-control form-control-lg bg-dark text-white border-accent @error('direccion') is-invalid @enderror"
                                           id="direccion"
                                           name="direccion"
                                           value="{{ old('direccion') }}"
                                           required>
                                    @error('direccion')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Rol -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="rol_id" class="form-label d-flex align-items-center">
                                        <span class="icon-wrapper me-2">
                                            <i class="fas fa-user-tag"></i>
                                        </span>
                                        Rol
                                    </label>
                                    <select class="form-select form-select-lg bg-dark text-white border-accent @error('rol_id') is-invalid @enderror"
                                            id="rol_id"
                                            name="rol_id"
                                            required>
                                        <option value="">Seleccione un rol</option>
                                        <option value="1" {{ old('rol_id') == 1 ? 'selected' : '' }}>Admin</option>
                                        <option value="2" {{ old('rol_id') == 2 ? 'selected' : '' }}>Cliente</option>
                                    </select>
                                    @error('rol_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="invalid-feedback">Debe seleccionar un rol.</div>
                                </div>
                            </div>

                            <!-- Contraseña -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password" class="form-label d-flex align-items-center">
                                        <span class="icon-wrapper me-2">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                        Contraseña
                                    </label>
                                    <input type="password"
                                           class="form-control form-control-lg bg-dark text-white border-accent @error('password') is-invalid @enderror"
                                           id="password"
                                           name="password"
                                           required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Botones de acción -->
                        <div class="d-flex justify-content-end gap-3 mt-4">
                            <a href="{{ route('admin.clientes.index') }}"
                               class="btn btn-lg btn-secondary">
                                <i class="fas fa-times me-2"></i>Cancelar
                            </a>
                            <button type="submit" class="btn btn-lg btn-gradient">
                                <i class="fas fa-save me-2"></i>Guardar Usuario
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .icon-wrapper {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 24px;
        height: 24px;
        background: var(--accent-color);
        border-radius: 50%;
        color: white;
    }

    .form-control, .form-select, .input-group-text {
        padding: 0.75rem 1rem;
        font-size: 1rem;
        line-height: 1.5;
        background-color: rgba(30, 41, 59, 0.8) !important;
        border: 2px solid var(--accent-color);
        color: white !important;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        background-color: rgba(30, 41, 59, 0.9) !important;
        border-color: var(--accent-color2);
        box-shadow: 0 0 0 0.25rem rgba(245, 158, 11, 0.25);
    }

    .btn-gradient {
        background: linear-gradient(45deg, var(--accent-color), var(--accent-color2));
        color: white;
        border: none;
        padding: 1rem 2rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
    }

    .btn {
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .btn:hover {
        transform: translateY(-2px);
    }

    .invalid-feedback {
        color: #ef4444;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('createUserForm');
    
    form.addEventListener('submit', function(event) {
        let isValid = true;
        
        // Validar nombre de usuario (letras y números, 5-12 caracteres)
        const nombreUsuario = document.getElementById('nombre_usuario');
        if (!/^[A-Za-z0-9]{5,12}$/.test(nombreUsuario.value)) {
            nombreUsuario.classList.add('is-invalid');
            isValid = false;
        } else {
            nombreUsuario.classList.remove('is-invalid');
        }
        
        // Validar email (dominios específicos)
        const email = document.getElementById('email');
        if (!/^[a-zA-Z][a-z0-9._%+-]*@(gmail|hotmail|outlook|yahoo|icloud|protonmail|aol)\.(com|net|org|edu|es|co|ec)/.test(email.value)) {
            email.classList.add('is-invalid');
            isValid = false;
        } else {
            email.classList.remove('is-invalid');
        }
        
        // Validar teléfono (comienza con 09, 10 dígitos)
        const telefono = document.getElementById('telefono');
        if (!/^09\d{8}$/.test(telefono.value)) {
            telefono.classList.add('is-invalid');
            isValid = false;
        } else {
            telefono.classList.remove('is-invalid');
        }
        
        // Validar que se haya seleccionado un rol
        const rolId = document.getElementById('rol_id');
        if (rolId.value === '') {
            rolId.classList.add('is-invalid');
            isValid = false;
        } else {
            rolId.classList.remove('is-invalid');
        }
        
        // Validar que se haya ingresado una dirección
        const direccion = document.getElementById('direccion');
        if (direccion.value.trim() === '') {
            direccion.classList.add('is-invalid');
            isValid = false;
        } else {
            direccion.classList.remove('is-invalid');
        }

        // Evitar envío del formulario si hay errores
        if (!isValid) {
            event.preventDefault();
            event.stopPropagation();
        }
    });
});
</script>
@endsection