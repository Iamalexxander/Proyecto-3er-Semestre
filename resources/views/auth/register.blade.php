@extends('layouts.app2')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 rounded-3xl overflow-hidden shadow-lg"
                 style="background: rgba(15, 23, 42, 0.8); backdrop-filter: blur(10px);">

                <!-- Header con gradiente -->
                <div class="card-header border-0 position-relative py-5">
                    <div class="position-absolute w-100 h-100 top-0 start-0"
                         style="background: linear-gradient(45deg, var(--accent-color), var(--accent-color2));
                                background-image: radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                                                radial-gradient(circle at 80% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);">
                    </div>
                    <div class="position-relative text-center">
                        <i class="fas fa-user-plus fa-4x mb-3 text-white"></i>
                        <h3 class="text-white mb-0 fw-bold">Crear Cuenta Nueva</h3>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('register') }}" class="needs-validation" id="registerForm">
                        @csrf
                        <div class="row g-4">
                            <!-- Nombre Completo -->
                            <div class="col-md-6">
                                <div class="position-relative">
                                    <input type="text"
                                           class="form-control bg-transparent text-white border-2 border-opacity-50 rounded-pill py-3 ps-4 pe-5 @error('nombre') is-invalid @enderror"
                                           id="nombre"
                                           name="nombre"
                                           value="{{ old('nombre') }}"
                                           required
                                           pattern="^[A-Za-zÁáÉéÍíÓóÚúÑñÜü\s]+$"
                                           title="Ingrese solo letras y espacios"
                                           placeholder="Nombre Completo">
                                    <i class="fas fa-user position-absolute top-50 end-0 translate-middle-y me-3 text-warning"></i>
                                    @error('nombre')
                                        <div class="invalid-feedback text-warning">{{ $message }}</div>
                                    @enderror
                                    <div class="invalid-feedback text-warning">Solo se permiten letras en el nombre.</div>
                                </div>
                            </div>

                            <!-- Nombre de Usuario -->
                            <div class="col-md-6">
                                <div class="position-relative">
                                    <input type="text"
                                           class="form-control bg-transparent text-white border-2 border-opacity-50 rounded-pill py-3 ps-4 pe-5 @error('nombre_usuario') is-invalid @enderror"
                                           id="nombre_usuario"
                                           name="nombre_usuario"
                                           value="{{ old('nombre_usuario') }}"
                                           required
                                           pattern="^[A-Za-z0-9]{5,12}$"
                                           title="Entre 5 y 12 caracteres, solo letras y números"
                                           placeholder="Nombre de Usuario">
                                    <i class="fas fa-at position-absolute top-50 end-0 translate-middle-y me-3 text-warning"></i>
                                    @error('nombre_usuario')
                                        <div class="invalid-feedback text-warning">{{ $message }}</div>
                                    @enderror
                                    <div class="invalid-feedback text-warning">Usuario debe tener entre 5 y 12 caracteres (solo letras y números).</div>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <div class="position-relative">
                                    <input type="email"
                                           class="form-control bg-transparent text-white border-2 border-opacity-50 rounded-pill py-3 ps-4 pe-5 @error('email') is-invalid @enderror"
                                           id="email"
                                           name="email"
                                           value="{{ old('email') }}"
                                           required
                                           pattern="[a-z0-9._%+-]+@(gmail|hotmail|outlook|yahoo|icloud|protonmail|aol)\.(com|net|org|edu|es|co|ec)"
                                           title="Ingrese un correo válido (gmail, hotmail, etc.)"
                                           placeholder="Correo Electrónico">
                                    <i class="fas fa-envelope position-absolute top-50 end-0 translate-middle-y me-3 text-warning"></i>
                                    @error('email')
                                        <div class="invalid-feedback text-warning">{{ $message }}</div>
                                    @enderror
                                    <div class="invalid-feedback text-warning">Ingrese un correo electrónico válido.</div>
                                </div>
                            </div>

                            <!-- Teléfono -->
                            <div class="col-md-6">
                                <div class="position-relative">
                                    <input type="tel"
                                           class="form-control bg-transparent text-white border-2 border-opacity-50 rounded-pill py-3 ps-4 pe-5 @error('telefono') is-invalid @enderror"
                                           id="telefono"
                                           name="telefono"
                                           value="{{ old('telefono') }}"
                                           required
                                           pattern="^09\d{8}$"
                                           title="Debe comenzar con 09 y tener 10 dígitos"
                                           placeholder="Teléfono (09XXXXXXXX)">
                                    <i class="fas fa-phone position-absolute top-50 end-0 translate-middle-y me-3 text-warning"></i>
                                    @error('telefono')
                                        <div class="invalid-feedback text-warning">{{ $message }}</div>
                                    @enderror
                                    <div class="invalid-feedback text-warning">El teléfono debe comenzar con 09 y tener 10 dígitos.</div>
                                </div>
                            </div>

                            <!-- Dirección -->
                            <div class="col-12">
                                <div class="position-relative">
                                    <input type="text"
                                           class="form-control bg-transparent text-white border-2 border-opacity-50 rounded-pill py-3 ps-4 pe-5 @error('direccion') is-invalid @enderror"
                                           id="direccion"
                                           name="direccion"
                                           value="{{ old('direccion') }}"
                                           required
                                           placeholder="Dirección">
                                    <i class="fas fa-map-marker-alt position-absolute top-50 end-0 translate-middle-y me-3 text-warning"></i>
                                    @error('direccion')
                                        <div class="invalid-feedback text-warning">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Contraseña -->
                            <div class="col-md-6">
                                <div class="position-relative">
                                    <input type="password"
                                           class="form-control bg-transparent text-white border-2 border-opacity-50 rounded-pill py-3 ps-4 pe-5 @error('password') is-invalid @enderror"
                                           id="password"
                                           name="password"
                                           required
                                           placeholder="Contraseña">
                                    <i class="fas fa-lock position-absolute top-50 end-0 translate-middle-y me-3 text-warning"></i>
                                    @error('password')
                                        <div class="invalid-feedback text-warning">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Confirmar Contraseña -->
                            <div class="col-md-6">
                                <div class="position-relative">
                                    <input type="password"
                                           class="form-control bg-transparent text-white border-2 border-opacity-50 rounded-pill py-3 ps-4 pe-5"
                                           id="password_confirmation"
                                           name="password_confirmation"
                                           required
                                           placeholder="Confirmar Contraseña">
                                    <i class="fas fa-lock position-absolute top-50 end-0 translate-middle-y me-3 text-warning"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Botón Submit -->
                        <button type="submit" class="btn w-100 py-3 mt-4 mb-3">
                            <i class="fas fa-user-plus me-2"></i>Crear Cuenta
                        </button>

                        <!-- Enlace a Login -->
                        <div class="text-center">
                            <p class="text-white-50 mb-0">
                                ¿Ya tienes cuenta?
                                <a href="{{ route('login') }}" class="text-warning text-decoration-none fw-bold">
                                    <i class="fas fa-sign-in-alt me-1"></i>Iniciar Sesión
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control {
        transition: all 0.3s ease;
    }

    .form-control:focus {
        box-shadow: 0 0 0 2px var(--accent-color);
        border-color: var(--accent-color);
    }

    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.5);
    }

    .rounded-3xl {
        border-radius: 1.5rem;
    }

    @media (max-width: 768px) {
        .container {
            padding: 1rem;
        }
    }
</style>

<script>
    // Validación personalizada del formulario
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('registerForm');
        
        form.addEventListener('submit', function(event) {
            let isValid = true;
            
            // Validar nombre (solo letras)
            const nombre = document.getElementById('nombre');
            if (!/^[A-Za-zÁáÉéÍíÓóÚúÑñÜü\s]+$/.test(nombre.value)) {
                nombre.classList.add('is-invalid');
                isValid = false;
            } else {
                nombre.classList.remove('is-invalid');
            }
            
            // Validar nombre de usuario (letras y números, 5-12 caracteres)
            const nombreUsuario = document.getElementById('nombre_usuario');
            if (!/^[A-Za-z0-9]{5,12}$/.test(nombreUsuario.value)) {
                nombreUsuario.classList.add('is-invalid');
                isValid = false;
            } else {
                nombreUsuario.classList.remove('is-invalid');
            }
            
            // Validar teléfono (comienza con 09, 10 dígitos)
            const telefono = document.getElementById('telefono');
            if (!/^09\d{8}$/.test(telefono.value)) {
                telefono.classList.add('is-invalid');
                isValid = false;
            } else {
                telefono.classList.remove('is-invalid');
            }
            
            const email = document.getElementById('email');
            if (!/^[a-zA-Z][a-z0-9._%+-]*@(gmail|hotmail|outlook|yahoo|icloud|protonmail|aol)\.(com|net|org|edu|es|co|ec)/.test(email.value)) {
                email.classList.add('is-invalid');
                isValid = false;
            } else {
                email.classList.remove('is-invalid');
            }

            if (!isValid) {
                event.preventDefault();
            }

        });
    });
</script>
@endsection