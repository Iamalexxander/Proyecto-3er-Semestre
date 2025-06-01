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
                        <i class="fas fa-key fa-4x mb-3 text-white"></i>
                        <h3 class="text-white mb-2 fw-bold">Recuperar Contraseña</h3>
                        <p class="text-white-50 mb-0">
                            Ingresa tu correo electrónico para recibir las instrucciones
                        </p>
                    </div>
                </div>

                <div class="card-body p-4">
                    @if (session('status'))
                        <div class="alert border-0 rounded-pill mb-4"
                             style="background: linear-gradient(45deg, var(--accent-color), var(--accent-color2));">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle me-2"></i>
                                {{ session('status') }}
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}" class="needs-validation">
                        @csrf

                        <!-- Campo de correo -->
                        <div class="position-relative mb-4">
                            <input type="email"
                                   class="form-control bg-transparent text-white border-2 border-opacity-50 rounded-pill py-3 ps-4 pe-5 @error('email') is-invalid @enderror"
                                   id="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   required
                                   placeholder="Correo Electrónico">
                            <i class="fas fa-envelope position-absolute top-50 end-0 translate-middle-y me-3 text-warning"></i>
                            @error('email')
                                <div class="invalid-feedback text-warning">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Botones -->
                        <div class="d-grid gap-3">
                            <button type="submit" class="btn w-100 py-3">
                                <i class="fas fa-paper-plane me-2"></i>
                                Enviar Instrucciones
                            </button>

                            <a href="{{ route('login') }}"
                               class="btn btn-outline-light w-100 py-3 rounded-pill">
                                <i class="fas fa-arrow-left me-2"></i>
                                Volver al Inicio de Sesión
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Información adicional -->
            <div class="text-center mt-4">
                <div class="bg-opacity-25 bg-dark p-3 rounded-pill inline-block">
                    <i class="fas fa-info-circle text-warning me-2"></i>
                    <span class="text-white-50">
                        Recibirás un correo con las instrucciones para crear una nueva contraseña
                    </span>
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

    .btn-outline-light {
        border: 2px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
    }

    .btn-outline-light:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: var(--accent-color);
        transform: translateY(-2px);
    }

    .alert {
        animation: slideIn 0.5s ease;
    }

    @keyframes slideIn {
        from {
            transform: translateY(-20px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    @media (max-width: 768px) {
        .container {
            padding: 1rem;
        }

        .card-header {
            padding: 2rem 1rem;
        }
    }
</style>
@endsection
