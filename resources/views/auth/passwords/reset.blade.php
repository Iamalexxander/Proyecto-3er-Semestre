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
                        <i class="fas fa-shield-alt fa-4x mb-3 text-white"></i>
                        <h3 class="text-white mb-2 fw-bold">Restablecer Contraseña</h3>
                        <p class="text-white-50 mb-0">
                            Crea una nueva contraseña segura para tu cuenta
                        </p>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('password.update') }}" class="needs-validation">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row g-4">
                            <!-- Campo de correo -->
                            <div class="col-12">
                                <div class="position-relative">
                                    <input type="email"
                                           class="form-control bg-transparent text-white border-2 border-opacity-50 rounded-pill py-3 ps-4 pe-5 @error('email') is-invalid @enderror"
                                           id="email"
                                           name="email"
                                           value="{{ old('email') }}"
                                           required
                                           placeholder="Correo Electrónico">
                                    <i class="fas fa-envelope position-absolute top-50 end-0 translate-middle-y me-3 text-warning"></i>
                                    @error('email')
                                        <div class="invalid-feedback text-warning">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Contraseña -->
                            <div class="col-12">
                                <div class="position-relative">
                                    <input type="password"
                                           class="form-control bg-transparent text-white border-2 border-opacity-50 rounded-pill py-3 ps-4 pe-5 @error('password') is-invalid @enderror"
                                           id="password"
                                           name="password"
                                           required
                                           placeholder="Nueva Contraseña">
                                    <i class="fas fa-lock position-absolute top-50 end-0 translate-middle-y me-3 text-warning password-toggle" style="cursor: pointer;"></i>
                                    @error('password')
                                        <div class="invalid-feedback text-warning">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="password-strength mt-2 rounded-pill" id="password-strength"></div>
                            </div>

                            <!-- Confirmar Contraseña -->
                            <div class="col-12">
                                <div class="position-relative">
                                    <input type="password"
                                           class="form-control bg-transparent text-white border-2 border-opacity-50 rounded-pill py-3 ps-4 pe-5"
                                           id="password_confirmation"
                                           name="password_confirmation"
                                           required
                                           placeholder="Confirmar Contraseña">
                                    <i class="fas fa-lock position-absolute top-50 end-0 translate-middle-y me-3 text-warning password-toggle" style="cursor: pointer;"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Requisitos de contraseña -->
                        <div class="password-requirements my-4 text-white-50 px-2">
                            <h6 class="text-warning mb-2 fw-bold">Requisitos de contraseña:</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="requirement mb-2" id="req-length">
                                        <i class="fas fa-circle-notch me-2 text-warning"></i>
                                        Mínimo 8 caracteres
                                    </div>
                                    <div class="requirement mb-2" id="req-uppercase">
                                        <i class="fas fa-circle-notch me-2 text-warning"></i>
                                        Al menos una mayúscula
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="requirement mb-2" id="req-number">
                                        <i class="fas fa-circle-notch me-2 text-warning"></i>
                                        Al menos un número
                                    </div>
                                    <div class="requirement mb-2" id="req-special">
                                        <i class="fas fa-circle-notch me-2 text-warning"></i>
                                        Al menos un carácter especial
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Botón Submit -->
                        <button type="submit" class="btn w-100 py-3 mt-2 mb-3">
                            <i class="fas fa-shield-alt me-2"></i>Restablecer Contraseña
                        </button>

                        <!-- Enlace a Login -->
                        <div class="text-center">
                            <p class="text-white-50 mb-0">
                                ¿Recordaste tu contraseña?
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

    .password-strength {
        height: 4px;
        width: 0%;
        transition: all 0.3s ease;
    }

    .btn {
        background: linear-gradient(45deg, var(--accent-color), var(--accent-color2));
        border: none;
        border-radius: 50px;
        color: white;
        font-weight: bold;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        z-index: 1;
    }

    .btn:before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: all 0.6s ease;
        z-index: -1;
    }

    .btn:hover:before {
        left: 100%;
    }

    .requirement {
        transition: all 0.3s ease;
    }

    .requirement.valid i {
        transform: rotate(360deg);
    }

    .requirement.valid {
        color: var(--accent-color);
    }

    .requirement.valid i {
        color: var(--accent-color);
    }

    .requirement.valid i:before {
        content: "\f058"; /* fa-check-circle */
    }

    @media (max-width: 768px) {
        .container {
            padding: 1rem;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle password visibility
    document.querySelectorAll('.password-toggle').forEach(icon => {
        icon.addEventListener('click', function() {
            const input = this.parentElement.querySelector('input');
            
            if (input.type === 'password') {
                input.type = 'text';
                this.classList.remove('fa-lock');
                this.classList.add('fa-lock-open');
            } else {
                input.type = 'password';
                this.classList.remove('fa-lock-open');
                this.classList.add('fa-lock');
            }
        });
    });

    // Password strength indicator and requirements validation
    const passwordInput = document.getElementById('password');
    const strengthIndicator = document.getElementById('password-strength');
    const requirements = {
        length: document.getElementById('req-length'),
        uppercase: document.getElementById('req-uppercase'),
        number: document.getElementById('req-number'),
        special: document.getElementById('req-special')
    };

    passwordInput.addEventListener('input', function() {
        const password = this.value;
        
        // Check requirements
        const hasLength = password.length >= 8;
        const hasUppercase = /[A-Z]/.test(password);
        const hasNumber = /[0-9]/.test(password);
        const hasSpecial = /[^A-Za-z0-9]/.test(password);
        
        // Update requirement indicators
        updateRequirement(requirements.length, hasLength);
        updateRequirement(requirements.uppercase, hasUppercase);
        updateRequirement(requirements.number, hasNumber);
        updateRequirement(requirements.special, hasSpecial);
        
        // Calculate strength
        let strength = 0;
        if (hasLength) strength += 25;
        if (hasUppercase) strength += 25;
        if (hasNumber) strength += 25;
        if (hasSpecial) strength += 25;
        
        // Update strength indicator
        updateStrengthIndicator(strength);
    });

    function updateRequirement(element, isValid) {
        if (isValid) {
            element.classList.add('valid');
        } else {
            element.classList.remove('valid');
        }
    }

    function updateStrengthIndicator(strength) {
        let color;
        if (strength <= 25) color = '#ff4444';
        else if (strength <= 50) color = '#ffbb33';
        else if (strength <= 75) color = '#00C851';
        else color = '#007E33';

        strengthIndicator.style.width = strength + '%';
        strengthIndicator.style.background = color;
    }
});
</script>
@endsection