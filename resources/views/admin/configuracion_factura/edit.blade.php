@extends('layouts.app')

@section('title', 'Configuración de Facturas')

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
                            <i class="fas fa-file-invoice fa-2x text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-white mb-0">Configuración de Facturas</h3>
                            <p class="text-white-50 mb-0">Personaliza la apariencia y contenido de tus facturas</p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4 text-white">
                    @if(session('success'))
                        <div class="alert alert-success border-0" style="background: rgba(16, 185, 129, 0.2);">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.configuracion_factura.update') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf
                        
                        <!-- Información de la Empresa -->
                        <div class="p-4 mb-4 rounded-3"
                             style="background: rgba(30, 41, 59, 0.5); border: 1px solid var(--accent-color);">
                            <h4 class="d-flex align-items-center mb-4">
                                <span class="icon-wrapper me-2">
                                    <i class="fas fa-building"></i>
                                </span>
                                Información de la Empresa
                            </h4>
                            
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label for="nit" class="form-label d-flex align-items-center">
                                        <span class="icon-wrapper me-2">
                                            <i class="fas fa-id-card"></i>
                                        </span>
                                        NIT/RUC *
                                    </label>
                                    <input type="text" 
                                           class="form-control form-control-lg bg-dark text-white border-accent @error('nit') is-invalid @enderror"
                                           id="nit" 
                                           name="nit"
                                           value="{{ old('nit', $configuracion->nit) }}" 
                                           required>
                                    @error('nit')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="direccion" class="form-label d-flex align-items-center">
                                        <span class="icon-wrapper me-2">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </span>
                                        Dirección *
                                    </label>
                                    <input type="text" 
                                           class="form-control form-control-lg bg-dark text-white border-accent @error('direccion') is-invalid @enderror"
                                           id="direccion" 
                                           name="direccion"
                                           value="{{ old('direccion', $configuracion->direccion) }}" 
                                           required>
                                    @error('direccion')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="telefono" class="form-label d-flex align-items-center">
                                        <span class="icon-wrapper me-2">
                                            <i class="fas fa-phone"></i>
                                        </span>
                                        Teléfono *
                                    </label>
                                    <input type="text" 
                                           class="form-control form-control-lg bg-dark text-white border-accent @error('telefono') is-invalid @enderror"
                                           id="telefono" 
                                           name="telefono"
                                           value="{{ old('telefono', $configuracion->telefono) }}" 
                                           required>
                                    @error('telefono')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label d-flex align-items-center">
                                        <span class="icon-wrapper me-2">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                        Email *
                                    </label>
                                    <input type="email" 
                                           class="form-control form-control-lg bg-dark text-white border-accent @error('email') is-invalid @enderror"
                                           id="email" 
                                           name="email"
                                           value="{{ old('email', $configuracion->email) }}" 
                                           required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="sitio_web" class="form-label d-flex align-items-center">
                                        <span class="icon-wrapper me-2">
                                            <i class="fas fa-globe"></i>
                                        </span>
                                        Sitio Web
                                    </label>
                                    <input type="text" 
                                           class="form-control form-control-lg bg-dark text-white border-accent @error('sitio_web') is-invalid @enderror"
                                           id="sitio_web" 
                                           name="sitio_web"
                                           value="{{ old('sitio_web', $configuracion->sitio_web) }}">
                                    @error('sitio_web')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Personalización de Factura -->
                        <div class="p-4 mb-4 rounded-3"
                             style="background: rgba(30, 41, 59, 0.5); border: 1px solid var(--accent-color);">
                            <h4 class="d-flex align-items-center mb-4">
                                <span class="icon-wrapper me-2">
                                    <i class="fas fa-paint-brush"></i>
                                </span>
                                Personalización de Factura
                            </h4>
                                
                                <div class="col-md-6">
                                    <label for="moneda" class="form-label d-flex align-items-center">
                                        <span class="icon-wrapper me-2">
                                            <i class="fas fa-dollar-sign"></i>
                                        </span>
                                        Símbolo de Moneda
                                    </label>
                                    <input type="text" 
                                           class="form-control form-control-lg bg-dark text-white border-accent @error('moneda') is-invalid @enderror"
                                           id="moneda" 
                                           name="moneda"
                                           value="{{ old('moneda', $configuracion->moneda) }}">
                                    @error('moneda')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Textos de Factura -->
                        <div class="p-4 mb-4 rounded-3"
                        style="background: rgba(30, 41, 59, 0.5); border: 1px solid var(--accent-color);">
                        <h4 class="d-flex align-items-center mb-4" style="color: white;">
                                <span class="icon-wrapper me-2">
                                    <i class="fas fa-font"></i>
                                </span>
                                Textos de Factura
                            </h4>

                            <div class="row g-4">
                                <div class="col-md-12">
                                    <label for="texto_footer" class="form-label d-flex align-items-center" style="color: white;">
                                        <span class="icon-wrapper me-2">
                                            <i class="fas fa-paragraph"></i>
                                        </span>
                                        Texto del Pie de Página
                                    </label>
                                    <textarea class="form-control form-control-lg bg-white text-white border-accent @error('texto_footer') is-invalid @enderror"
                                              id="texto_footer" 
                                              name="texto_footer" 
                                              rows="3">{{ old('texto_footer', $configuracion->texto_footer) }}</textarea>
                                    @error('texto_footer')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <label for="texto_condiciones" class="form-label d-flex align-items-center" style="color: white;">
                                        <span class="icon-wrapper me-2">
                                            <i class="fas fa-gavel"></i>
                                        </span>
                                        Términos y Condiciones
                                    </label>
                                    <textarea class="form-control form-control-lg bg-dark text-white border-accent @error('texto_condiciones') is-invalid @enderror"
                                              id="texto_condiciones" 
                                              name="texto_condiciones" 
                                              rows="3">{{ old('texto_condiciones', $configuracion->texto_condiciones) }}</textarea>
                                    @error('texto_condiciones')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <label for="texto_agradecimiento" class="form-label d-flex align-items-center" style="color: white;">
                                        <span class="icon-wrapper me-2">
                                            <i class="fas fa-heart"></i>
                                        </span>
                                        Mensaje de Agradecimiento
                                    </label>
                                    <textarea class="form-control form-control-lg bg-dark text-white border-accent @error('texto_agradecimiento') is-invalid @enderror"
                                              id="texto_agradecimiento" 
                                              name="texto_agradecimiento" 
                                              rows="2">{{ old('texto_agradecimiento', $configuracion->texto_agradecimiento) }}</textarea>
                                    @error('texto_agradecimiento')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <label for="texto_firma" class="form-label d-flex align-items-center" style="color: white;">
                                        <span class="icon-wrapper me-2">
                                            <i class="fas fa-signature"></i>
                                        </span>
                                        Texto de Firma
                                    </label>
                                    <input type="text" 
                                           class="form-control form-control-lg bg-dark text-white border-accent @error('texto_firma') is-invalid @enderror"
                                           id="texto_firma" 
                                           name="texto_firma"
                                           value="{{ old('texto_firma', $configuracion->texto_firma) }}">
                                    @error('texto_firma')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-3 mt-4">
                            <a href="{{ route('admin.reportes.index') }}" class="btn btn-lg btn-secondary">
                                <i class="fas fa-times me-2"></i>Cancelar
                            </a>
                            <button type="submit" class="btn btn-lg btn-warning">
                                <i class="fas fa-save me-2"></i>Guardar Configuración
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

    .form-check-input {
        width: 1.5em;
        height: 1.5em;
        margin-top: 0.25em;
        margin-right: 1em;
        background-color: rgba(30, 41, 59, 0.8);
        border: 2px solid var(--accent-color);
    }

    .form-check-input:checked {
        background-color: var(--accent-color);
        border-color: var(--accent-color);
    }

    textarea.form-control {
        resize: vertical;
        min-height: 80px;
    }

    .btn-lg {
        padding: 0.75rem 1.5rem;
        font-size: 1.1rem;
    }

    .btn-warning {
        background-color: var(--accent-color);
        border-color: var(--accent-color);
        color: white;
    }

    .btn-warning:hover {
        background-color: var(--accent-color-dark, #e6a23c);
        border-color: var(--accent-color-dark, #e6a23c);
        color: white;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Actualizar el campo de texto cuando cambia el color
        document.getElementById('color_primario').addEventListener('input', function() {
            document.getElementById('color_text').value = this.value;
        });
    });
</script>
@endsection