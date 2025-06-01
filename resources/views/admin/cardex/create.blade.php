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
                            <i class="fas fa-exchange-alt fa-2x text-white"></i>
                        </div>
                        <h3 class="text-white mb-0 flex-grow-1">Registrar Movimiento de Inventario</h3>
                    </div>
                </div>

                <div class="card-body p-4 text-white">
                    <form action="{{ route('admin.cardex.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="row g-4">
                            <!-- Columna Izquierda -->
                            <div class="col-md-6">
                                <!-- Producto -->
                                <div class="form-group mb-4">
                                    <label for="producto_id" class="form-label d-flex align-items-center">
                                        <span class="icon-wrapper me-2">
                                            <i class="fas fa-box"></i>
                                        </span>
                                        Seleccionar Producto
                                    </label>
                                    <select name="producto_id"
                                            id="producto_id"
                                            class="form-select form-select-lg bg-dark text-white border-accent @error('producto_id') is-invalid @enderror"
                                            required>
                                        <option value="">Seleccione un producto</option>
                                        @foreach($productos as $producto)
                                            <option value="{{ $producto->id }}"
                                                    data-stock="{{ $producto->cantidad_disponible }}"
                                                    {{ old('producto_id') == $producto->id ? 'selected' : '' }}>
                                                {{ $producto->nombre }} (Stock: {{ $producto->cantidad_disponible }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('producto_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Stock Actual -->
                                <div class="stock-info-card p-4 mb-4 rounded-3"
                                     style="background: rgba(30, 41, 59, 0.5); border: 1px solid var(--accent-color);">
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="icon-wrapper me-2">
                                            <i class="fas fa-cubes"></i>
                                        </span>
                                        <h5 class="mb-0">Stock Actual</h5>
                                    </div>
                                    <div class="stock-display p-3 rounded bg-dark">
                                        <span id="stockActual" class="fs-4 text-warning">
                                            Seleccione un producto
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Columna Derecha -->
                            <div class="col-md-6">
                                <!-- Tipo de Movimiento -->
                                <div class="form-group mb-4">
                                    <label for="tipo_movimiento" class="form-label d-flex align-items-center">
                                        <span class="icon-wrapper me-2">
                                            <i class="fas fa-exchange-alt"></i>
                                        </span>
                                        Tipo de Movimiento
                                    </label>
                                    <div class="d-flex gap-3">
                                        <div class="form-check form-check-inline flex-grow-1">
                                            <input class="form-check-input" type="radio" name="tipo_movimiento"
                                                   id="movimiento_compra" value="compra" checked>
                                            <label class="form-check-label movement-label compra" for="movimiento_compra">
                                                <i class="fas fa-arrow-up me-2"></i>Compra (Entrada)
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline flex-grow-1">
                                            <input class="form-check-input" type="radio" name="tipo_movimiento"
                                                   id="movimiento_venta" value="venta">
                                            <label class="form-check-label movement-label venta" for="movimiento_venta">
                                                <i class="fas fa-arrow-down me-2"></i>Venta (Salida)
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Cantidad -->
                                <div class="form-group mb-4">
                                    <label for="cantidad" class="form-label d-flex align-items-center">
                                        <span class="icon-wrapper me-2">
                                            <i class="fas fa-sort-numeric-up"></i>
                                        </span>
                                        Cantidad
                                    </label>
                                    <div class="input-group">
                                        <input type="number"
                                               class="form-control form-control-lg bg-dark text-white border-accent @error('cantidad') is-invalid @enderror"
                                               id="cantidad"
                                               name="cantidad"
                                               min="1"
                                               value="{{ old('cantidad') }}"
                                               required>
                                        <span class="input-group-text bg-dark text-white border-accent">unidades</span>
                                    </div>
                                    <div id="cantidadHelp" class="form-text text-warning"></div>
                                    @error('cantidad')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Preview del Movimiento -->
                                <div class="movement-preview p-4 rounded-3 mb-4"
                                     style="background: rgba(30, 41, 59, 0.5); border: 1px solid var(--accent-color);">
                                    <h5 class="mb-3">
                                        <i class="fas fa-calculator me-2"></i>
                                        Preview del Movimiento
                                    </h5>
                                    <div class="preview-content">
                                        <div class="row mb-2">
                                            <div class="col-6">Stock Actual:</div>
                                            <div class="col-6 text-end" id="previewStockActual">0</div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6">Movimiento:</div>
                                            <div class="col-6 text-end" id="previewMovimiento">+0</div>
                                        </div>
                                        <hr style="border-color: var(--accent-color)">
                                        <div class="row">
                                            <div class="col-6">Stock Final:</div>
                                            <div class="col-6 text-end" id="previewStockFinal">0</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-3 mt-4">
                            <a href="{{ route('admin.cardex.index') }}"
                               class="btn btn-lg btn-secondary">
                                <i class="fas fa-times me-2"></i>Cancelar
                            </a>
                            <button type="submit" class="btn btn-lg btn-gradient">
                                <i class="fas fa-save me-2"></i>Registrar Movimiento
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

    .movement-label {
        display: block;
        padding: 1rem;
        border-radius: 0.5rem;
        border: 2px solid var(--accent-color);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .movement-label.compra {
        border-color: #10b981;
    }

    .movement-label.venta {
        border-color: #ef4444;
    }

    .form-check-input:checked + .movement-label.compra {
        background: rgba(16, 185, 129, 0.2);
    }

    .form-check-input:checked + .movement-label.venta {
        background: rgba(239, 68, 68, 0.2);
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

    .preview-content {
        background: rgba(15, 23, 42, 0.5);
        padding: 1rem;
        border-radius: 0.5rem;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const productoSelect = document.getElementById('producto_id');
    const tipoMovimiento = document.getElementsByName('tipo_movimiento');
    const cantidad = document.getElementById('cantidad');
    const stockActual = document.getElementById('stockActual');
    const cantidadHelp = document.getElementById('cantidadHelp');
    const submitBtn = document.querySelector('button[type="submit"]');

    // Preview elements
    const previewStockActual = document.getElementById('previewStockActual');
    const previewMovimiento = document.getElementById('previewMovimiento');
    const previewStockFinal = document.getElementById('previewStockFinal');

    function actualizarStockActual() {
        const selectedOption = productoSelect.options[productoSelect.selectedIndex];
        const stock = selectedOption.dataset.stock;
        stockActual.textContent = stock ? stock + ' unidades' : 'Seleccione un producto';
        actualizarPreview();
    }

    function actualizarPreview() {
        const selectedOption = productoSelect.options[productoSelect.selectedIndex];
        const stock = parseInt(selectedOption.dataset.stock) || 0;
        const cantidadValue = parseInt(cantidad.value) || 0;
        const isCompra = document.getElementById('movimiento_compra').checked;

        previewStockActual.textContent = stock;
        previewMovimiento.textContent = isCompra ? `+${cantidadValue}` : `-${cantidadValue}`;
        previewStockFinal.textContent = isCompra ? stock + cantidadValue : stock - cantidadValue;

        // Validación
        if (!isCompra && cantidadValue > stock) {
            cantidadHelp.textContent = 'No hay suficiente stock disponible';
            submitBtn.disabled = true;
        } else {
            cantidadHelp.textContent = '';
            submitBtn.disabled = false;
        }
    }

    productoSelect.addEventListener('change', actualizarStockActual);
    cantidad.addEventListener('input', actualizarPreview);
    tipoMovimiento.forEach(radio => {
        radio.addEventListener('change', actualizarPreview);
    });
});
</script>
@endsection
