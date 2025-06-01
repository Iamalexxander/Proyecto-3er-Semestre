@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-2xl" style="background: rgba(15, 23, 42, 0.95); backdrop-filter: blur(20px);">
                <div class="card-header border-bottom border-accent p-4"
                     style="background: linear-gradient(45deg, var(--primary-color), var(--secondary-color))">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle p-3 me-3" style="background: var(--accent-color)">
                            <i class="fas fa-edit fa-2x text-white"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h3 class="text-white mb-0">Editar Categoría</h3>
                            <p class="text-white-50 mb-0">{{ $categoria->nombre }}</p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4 text-white">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.categorias.update', $categoria) }}" method="POST" class="needs-validation" onsubmit="return validateForm()" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="row g-4">
                            <!-- Información Principal -->
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label for="nombre" class="form-label d-flex align-items-center">
                                        <span class="icon-wrapper me-2">
                                            <i class="fas fa-tag"></i>
                                        </span>
                                        Nombre de la Categoría
                                    </label>
                                    <input type="text"
                                           class="form-control form-control-lg bg-dark text-white border-accent @error('nombre') is-invalid @enderror"
                                           id="nombre"
                                           name="nombre"
                                           value="{{ old('nombre', $categoria->nombre) }}"
                                           pattern="^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ\s]{4,20}$"
                                           title="Solo se permiten letras. Mínimo 4 y máximo 20 caracteres."
                                           required>
                                    @error('nombre')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-white-50 mt-2 d-block">
                                        Solo letras permitidas. Mínimo 4 y máximo 20 caracteres.
                                    </small>
                                </div>
                            </div>

                            <!-- Información Adicional -->
                            <div class="col-md-6">
                                <div class="info-card p-4 rounded-3 h-100"
                                     style="background: rgba(30, 41, 59, 0.5); border: 1px solid var(--accent-color);">
                                    <h5 class="mb-4 d-flex align-items-center">
                                        <span class="icon-wrapper me-2">
                                            <i class="fas fa-info-circle"></i>
                                        </span>
                                        Información de la Categoría
                                    </h5>

                                    <div class="info-item mb-4">
                                        <div class="d-flex align-items-center mb-3">
                                            <span class="icon-wrapper me-2">
                                                <i class="fas fa-cubes"></i>
                                            </span>
                                            <h6 class="mb-0">Productos Asociados</h6>
                                        </div>
                                        <div class="p-3 rounded-3" style="background: rgba(245, 158, 11, 0.1);">
                                            <span class="badge bg-gradient fs-5">
                                                {{ $categoria->productos->count() }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="info-item">
                                        <div class="d-flex align-items-center mb-3">
                                            <span class="icon-wrapper me-2">
                                                <i class="fas fa-clock"></i>
                                            </span>
                                            <h6 class="mb-0">Última Actualización</h6>
                                        </div>
                                        <div class="p-3 rounded-3" style="background: rgba(245, 158, 11, 0.1);">
                                            <span class="badge bg-gradient fs-6">
                                                {{ $categoria->updated_at->format('d/m/Y H:i:s') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Botones de Acción -->
                            <div class="col-12 d-flex justify-content-end mt-4">
                                <a href="{{ route('admin.categorias.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                                <button type="submit" class="btn" style="background: var(--accent-color)">
                                    <i class="fas fa-save me-2"></i>Actualizar Categoría
                                </button>
                            </div>
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

    .form-control {
        padding: 0.75rem 1rem;
        font-size: 1rem;
        line-height: 1.5;
        background-color: rgba(30, 41, 59, 0.8) !important;
        border: 2px solid var(--accent-color);
        color: white !important;
        transition: all 0.3s ease;
    }

    .form-control:focus {
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

    .bg-gradient {
        background: linear-gradient(45deg, var(--accent-color), var(--accent-color2));
    }

    .bg-gradient-secondary {
        background: linear-gradient(45deg, var(--secondary-color), var(--accent-color));
    }

    .badge {
        padding: 0.75rem 1.5rem;
        font-weight: 500;
        letter-spacing: 0.5px;
    }

    .info-item {
        transition: all 0.3s ease;
    }

    .info-item:hover {
        transform: translateY(-2px);
    }

    @media (max-width: 768px) {
        .container {
            padding: 1rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        .btn {
            width: 100%;
            margin-bottom: 0.5rem;
        }

        .d-flex.justify-content-end {
            flex-direction: column;
        }

        .info-card {
            margin-top: 1rem;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');

    // Validación del formulario
    form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }
        form.classList.add('was-validated');
    });
});

function validateForm() {
    const nombreInput = document.getElementById('nombre');
    const nombre = nombreInput.value.trim();
    const regexLetrasOnly = /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ\s]{4,20}$/;
    
    if (!regexLetrasOnly.test(nombre)) {
        alert('El nombre de la categoría debe contener solo letras y tener entre 4 y 20 caracteres.');
        nombreInput.focus();
        return false;
    }
    
    return true;
}
</script>
@endsection
