@extends('layouts.app2')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 rounded-3xl overflow-hidden shadow-lg"
                 style="background: rgba(15, 23, 42, 0.8); backdrop-filter: blur(10px);">
                <!-- Encabezado con gradiente -->
                <div class="card-header border-0 position-relative py-5">
                    <div class="position-absolute w-100 h-100 top-0 start-0"
                         style="background: linear-gradient(45deg, var(--accent-color), var(--accent-color2));
                                background-image: radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                                                radial-gradient(circle at 80% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
                                z-index: 0;">
                    </div>
                    <div class="position-relative text-center z-1">
                        <i class="fas fa-user-circle fa-4x mb-3 text-white"></i>
                        <h3 class="text-white mb-0 fw-bold">Iniciar Sesión</h3>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('login') }}" class="needs-validation">
                        @csrf
                        <!-- Campo Email -->
                        <div class="mb-4">
                            <div class="position-relative">
                                <input type="email"
                                       class="form-control bg-transparent text-white border-2 border-opacity-50 rounded-pill py-3 ps-4 pe-5 @error('email') is-invalid @enderror"
                                       id="email"
                                       name="email"
                                       value="{{ old('email') }}"
                                       required
                                       placeholder="Correo Electrónico">
                                <i class="fas fa-envelope position-absolute top-50 end-0 translate-middle-y me-3 text-warning"></i>
                            </div>
                            @error('email')
                                <div class="invalid-feedback text-warning">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Campo Contraseña -->
                        <div class="mb-4">
                            <div class="position-relative">
                                <input type="password"
                                       class="form-control bg-transparent text-white border-2 border-opacity-50 rounded-pill py-3 ps-4 pe-5 @error('password') is-invalid @enderror"
                                       id="password"
                                       name="password"
                                       required
                                       placeholder="Contraseña">
                                <i class="fas fa-lock position-absolute top-50 end-0 translate-middle-y me-3 text-warning"></i>
                            </div>
                            @error('password')
                                <div class="invalid-feedback text-warning">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Checkbox Recordar -->
                        <div class="form-check mb-4">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label text-white" for="remember">
                                Recordarme
                            </label>
                        </div>

                        <!-- Botón Submit -->
                        <button type="submit" class="btn w-100 py-3 mb-4">
                            <i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión
                        </button>

                        <!-- Enlaces -->
                        <div class="text-center">
                            <a href="{{ route('password.request') }}" class="text-warning text-decoration-none d-block mb-3">
                                <i class="fas fa-key me-2"></i>¿Olvidaste tu contraseña?
                            </a>
                            <p class="text-white-50 mb-0">
                                ¿No tienes cuenta?
                                <a href="{{ route('register') }}" class="text-warning text-decoration-none fw-bold">
                                    <i class="fas fa-user-plus me-1"></i>Regístrate
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

    .form-check-input:checked {
        background-color: var(--accent-color);
        border-color: var(--accent-color);
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
@endsection
