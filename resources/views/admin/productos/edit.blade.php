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
                            <h3 class="text-white mb-0">Editar Producto</h3>
                            <p class="text-white-50 mb-0">{{ $producto->nombre }}</p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4 text-white">
                    <form action="{{ route('admin.productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="row g-4">
                            <!-- Columna Izquierda -->
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label for="nombre" class="form-label d-flex align-items-center">
                                        <span class="icon-wrapper me-2">
                                            <i class="fas fa-tag"></i>
                                        </span>
                                        Nombre del Producto
                                    </label>
                                    <input type="text"
                                            class="form-control form-control-lg bg-dark text-white border-accent @error('nombre') is-invalid @enderror"
                                            id="nombre"
                                            name="nombre"
                                            value="{{ old('nombre', $producto->nombre) }}"
                                            minlength="3"
                                            maxlength="20"
                                            pattern="^[A-Za-zÀ-ÖØ-öø-ÿ\s]+$"
                                            required>
                                    @error('nombre')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="invalid-feedback">
                                        El nombre debe contener solo letras, tener entre 3 y 20 caracteres.
                                    </div>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="descripcion" class="form-label d-flex align-items-center">
                                        <span class="icon-wrapper me-2">
                                            <i class="fas fa-align-left"></i>
                                        </span>
                                        Descripción
                                    </label>
                                    <textarea class="form-control bg-dark text-white border-accent @error('descripcion') is-invalid @enderror"
                                            id="descripcion"
                                            name="descripcion"
                                            rows="4"
                                            minlength="5"
                                            maxlength="200"
                                            required>{{ old('descripcion', $producto->descripcion) }}</textarea>
                                    @error('descripcion')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="invalid-feedback">
                                        La descripción no puede estar vacía.
                                    </div>
                                </div>

                                <div class="row g-3 mb-4">
                                    <div class="col-6">
                                        <label for="precio" class="form-label d-flex align-items-center">
                                            <span class="icon-wrapper me-2">
                                                <i class="fas fa-dollar-sign"></i>
                                            </span>
                                            Precio
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-dark text-white border-accent">$</span>
                                            <input type="number"
                                            step="0.01"
                                            min="0.01"
                                            class="form-control bg-dark text-white border-accent @error('precio') is-invalid @enderror"
                                            id="precio"
                                            name="precio"
                                            value="{{ old('precio', $producto->precio ?? '') }}"
                                            required>
                                        </div>
                                        @error('precio')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="invalid-feedback">
                                            El precio debe ser mayor a 0.
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <label for="cantidad_disponible" class="form-label d-flex align-items-center">
                                            <span class="icon-wrapper me-2">
                                                <i class="fas fa-cubes"></i>
                                            </span>
                                            Stock
                                        </label>
                                        <input type="number"
                                               class="form-control bg-dark text-white border-accent @error('cantidad_disponible') is-invalid @enderror"
                                               id="cantidad_disponible"
                                               name="cantidad_disponible"
                                               value="{{ old('cantidad_disponible', $producto->cantidad_disponible) }}"
                                               min="0"
                                               required>
                                        @error('cantidad_disponible')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="invalid-feedback">
                                            La cantidad disponible debe ser un número mayor o igual a 0.
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="categoria_id" class="form-label d-flex align-items-center">
                                        <span class="icon-wrapper me-2">
                                            <i class="fas fa-folder"></i>
                                        </span>
                                        Categoría
                                    </label>
                                    <select class="form-select bg-dark text-white border-accent @error('categoria_id') is-invalid @enderror"
                                            id="categoria_id"
                                            name="categoria_id"
                                            required>
                                        <option value="">Seleccione una categoría</option>
                                        @foreach($categorias as $categoria)
                                            <option value="{{ $categoria->id }}"
                                                    {{ (old('categoria_id', $producto->categoria_id) == $categoria->id) ? 'selected' : '' }}>
                                                {{ $categoria->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('categoria_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="invalid-feedback">
                                        Debe seleccionar una categoría.
                                    </div>
                                </div>
                            </div>

                            <!-- Columna Derecha -->
                            <div class="col-md-6">
                                <div class="current-image-container p-4 rounded-3 mb-4"
                                     style="background: rgba(30, 41, 59, 0.5); border: 1px solid var(--accent-color);">
                                    <label class="form-label d-flex align-items-center mb-3">
                                        <span class="icon-wrapper me-2">
                                            <i class="fas fa-image"></i>
                                        </span>
                                        Imagen Actual
                                    </label>
                                    <div class="current-image-wrapper">
                                        <img src="{{ asset($producto->imagen) }}"
                                             alt="Imagen actual"
                                             class="current-image">
                                    </div>
                                </div>

                                <div class="image-selection-container p-4 rounded-3"
                                     style="background: rgba(30, 41, 59, 0.5); border: 1px dashed var(--accent-color);">
                                    <label class="form-label d-flex align-items-center mb-3">
                                        <span class="icon-wrapper me-2">
                                            <i class="fas fa-exchange-alt"></i>
                                        </span>
                                        Cambiar Imagen
                                    </label>
                                    <div class="image-grid">
                                        @foreach($imagenes as $imagen)
                                        <div class="image-option-wrapper">
                                            <input type="radio"
                                                   name="imagen"
                                                   id="imagen_{{ $loop->index }}"
                                                   value="{{ $imagen }}"
                                                   class="image-radio"
                                                   {{ $producto->imagen == $imagen ? 'checked' : '' }}>
                                            <label for="imagen_{{ $loop->index }}" class="image-label">
                                                <img src="{{ asset($imagen) }}"
                                                     alt="Opción de imagen"
                                                     class="preview-image">
                                                <div class="image-overlay">
                                                    <i class="fas fa-check-circle"></i>
                                                </div>
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-3 mt-4">
                            <a href="{{ route('admin.productos.index') }}"
                               class="btn btn-lg btn-secondary">
                                <i class="fas fa-times me-2"></i>Cancelar
                            </a>
                            <button type="submit" class="btn btn-lg btn-gradient">
                                <i class="fas fa-save me-2"></i>Actualizar Producto
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

    .current-image-wrapper {
        position: relative;
        border-radius: 0.5rem;
        overflow: hidden;
        aspect-ratio: 16/9;
    }

    .current-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
    }

    .image-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
        gap: 1rem;
        max-height: 300px;
        overflow-y: auto;
        padding: 0.5rem;
    }

    .image-option-wrapper {
        position: relative;
    }

    .image-radio {
        display: none;
    }

    .image-label {
        display: block;
        cursor: pointer;
        position: relative;
        border-radius: 0.5rem;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .preview-image {
        width: 100%;
        aspect-ratio: 1;
        object-fit: cover;
        border-radius: 0.5rem;
        border: 2px solid transparent;
        transition: all 0.3s ease;
    }

    .image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(15, 23, 42, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: all 0.3s ease;
    }

    .image-overlay i {
        color: var(--accent-color);
        font-size: 2rem;
        transform: scale(0.5);
        transition: all 0.3s ease;
    }

    .image-radio:checked + .image-label .preview-image {
        border-color: var(--accent-color);
        transform: scale(0.95);
    }

    .image-radio:checked + .image-label .image-overlay {
        opacity: 1;
    }

    .image-radio:checked + .image-label .image-overlay i {
        transform: scale(1);
    }

    .image-label:hover .preview-image {
        transform: scale(0.95);
    }

    .image-label:hover .image-overlay {
        opacity: 1;
    }

    /* Scrollbar Styling */
    .image-grid::-webkit-scrollbar {
        width: 8px;
    }

    .image-grid::-webkit-scrollbar-track {
        background: rgba(30, 41, 59, 0.5);
        border-radius: 4px;
    }

    .image-grid::-webkit-scrollbar-thumb {
        background: var(--accent-color);
        border-radius: 4px;
    }

    .image-grid::-webkit-scrollbar-thumb:hover {
        background: var(--accent-color2);
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const imageLabels = document.querySelectorAll('.image-label');
    const nombreInput = document.getElementById('nombre');
    const descripcionInput = document.getElementById('descripcion');
    const precioInput = document.getElementById('precio');
    const stockInput = document.getElementById('cantidad_disponible');
    const categoriaSelect = document.getElementById('categoria_id');

    // Animación al seleccionar imágenes
    imageLabels.forEach(label => {
        label.addEventListener('click', function() {
            imageLabels.forEach(l => l.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // Validación personalizada para nombre (solo letras)
        nombreInput.addEventListener('input', function() {
        const regex = /^[A-Za-zÀ-ÖØ-öø-ÿ\s]+$/;
        if (this.value.length > 0 && !regex.test(this.value)) {
            this.setCustomValidity('El nombre debe contener solo letras.');
        } else if (this.value.length < 3 || this.value.length > 20) {
            this.setCustomValidity('El nombre debe tener entre 3 y 20 caracteres.');
        } else {
            this.setCustomValidity('');
        }
    });

    // Validación de precio (no negativo)
    precioInput.addEventListener('input', function() {
        if (parseFloat(this.value) <= 0) {
            this.setCustomValidity('El precio debe ser mayor a 0.');
        } else {
            this.setCustomValidity('');
        }
    });

        descripcionInput.addEventListener('input', function() {
        if (this.value.length < 5) {
            this.setCustomValidity('La descripción debe tener al menos 5 caracteres.');
        } else if (this.value.length > 200) {
            this.setCustomValidity('La descripción no puede exceder los 200 caracteres.');
        } else {
            this.setCustomValidity('');
        }
    });

    // Validación de stock (no negativo)
    stockInput.addEventListener('input', function() {
        if (parseInt(this.value) < 0) {
            this.setCustomValidity('La cantidad disponible debe ser un número positivo.');
        } else {
            this.setCustomValidity('');
        }
    });

    // Validación del formulario
    form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }
        form.classList.add('was-validated');
    });
});
</script>
@endsection