@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg" style="background: rgba(30, 41, 59, 0.8); backdrop-filter: blur(10px);">
                <div class="card-header border-bottom border-accent">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="text-white font-playfair mb-0">
                            <i class="fas fa-plus me-2"></i>Nueva Categoría
                        </h2>
                        <a href="{{ route('admin.categorias.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Volver
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.categorias.store') }}" method="POST" onsubmit="return validateForm()">
                        @csrf
                        <div class="mb-4">
                            <label for="nombre" class="form-label text-white">Nombre de la Categoría</label>
                            <input type="text"
                                   id="nombre"
                                   name="nombre"
                                   class="form-control bg-dark text-white @error('nombre') is-invalid @enderror"
                                   value="{{ old('nombre') }}"
                                   pattern="^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ\s]{4,}$"
                                   title="Solo se permiten letras. Mínimo 4 caracteres."
                                   required
                                   autofocus>
                            @error('nombre')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <small class="text-white-50">Solo letras permitidas. Mínimo 4 caracteres.</small>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.categorias.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                            <button type="submit" class="btn" style="background: var(--accent-color)">
                                <i class="fas fa-save me-2"></i>Guardar Categoría
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control {
        background-color: rgba(30, 41, 59, 0.8) !important;
        border: 1px solid var(--accent-color);
        color: white !important;
    }

    .form-control:focus {
        background-color: rgba(30, 41, 59, 0.9) !important;
        border-color: var(--accent-color2);
        box-shadow: 0 0 0 0.25rem rgba(245, 158, 11, 0.25);
        color: white !important;
    }
</style>

<script>
function validateForm() {
    const nombreInput = document.getElementById('nombre');
    const nombre = nombreInput.value.trim();
    const regexLetrasOnly = /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ\s]{4,20}$/;
    
    if (!regexLetrasOnly.test(nombre)) {
        alert('El nombre de la categoría debe contener solo letras y tener al menos 4 caracteres.');
        nombreInput.focus();
        return false;
    }
    
    return true;
}
</script>
@endsection