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
                            <i class="fas fa-edit fa-2x text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-white mb-0">Editar Movimiento de Inventario</h3>
                            <p class="text-white-50 mb-0">Modificar registro #{{ $cardex->id }}</p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4 text-white">
                    <form action="{{ route('admin.cardex.update', $cardex->id) }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="row g-4">
                            <!-- Columna Izquierda -->
                            <div class="col-md-6">
                                <!-- Movimiento Original -->
                                <div class="original-movement-card p-4 mb-4 rounded-3"
                                     style="background: rgba(30, 41, 59, 0.5); border: 1px solid var(--accent-color);">
                                    <h5 class="d-flex align-items-center mb-3">
                                        <span class="icon-wrapper me-2">
                                            <i class="fas fa-history"></i>
                                        </span>
                                        Movimiento Original
                                    </h5>
                                    <div class="row g-3">
                                        <div class="col-6">
                                            <label class="text-white-50">Fecha:</label>
                                            <p class="mb-0">{{ \Carbon\Carbon::parse($cardex->fecha)->format('d/m/Y H:i') }}</p>                                        </div>
                                        <div class="col-6">
                                            <label class="text-white-50">Tipo:</label>
                                            <p class="mb-0">
                                                <span class="badge {{ $cardex->tipo_movimiento == 'compra' ? 'bg-success' : 'bg-warning' }}">
                                                    {{ ucfirst($cardex->tipo_movimiento) }}
                                                </span>
                                            </p>
                                        </div>
                                        <div class="col-6">
                                            <label class="text-white-50">Cantidad:</label>
                                            <p class="mb-0">{{ number_format($cardex->cantidad) }}</p>
                                        </div>
                                        <div class="col-6">
                                            <label class="text-white-50">Saldo resultante:</label>
                                            <p class="mb-0">{{ number_format($cardex->saldo) }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Producto -->
                                <div class="form-group mb-4">
                                    <label for="producto_id" class="form-label d-flex align-items-center">
                                        <span class="icon-wrapper me-2">
                                            <i class="fas fa-box"></i>
                                        </span>
                                        Producto
                                    </label>
                                    <select name="producto_id"
                                            id="producto_id"
                                            class="form-select form-select-lg bg-dark text-white border-accent @error('producto_id') is-invalid @enderror"
                                            required>
                                        @foreach($productos as $producto)
                                            <option value="{{ $producto->id }}"
                                                    data-stock="{{ $producto->cantidad_disponible }}"
                                                    {{ $cardex->producto_id == $producto->id ? 'selected' : '' }}>
                                                {{ $producto->nombre }} (Stock actual: {{ $producto->cantidad_disponible }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('producto_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Columna Derecha -->
                            <div class="col-md-6">
                                <!-- Tipo de Movimiento -->
                                <div class="form-group mb-4">
                                    <label class="form-label d-flex align-items-center">
                                        <span class="icon-wrapper me-2">
                                            <i class="fas fa-exchange-alt"></i>
                                        </span>
                                        Tipo de Movimiento
                                    </label>
                                    <div class="d-flex gap-3">
                                        <div class="form-check form-check-inline flex-grow-1">
                                            <input class="form-check-input" type="radio" name="tipo_movimiento"
                                                   id="movimiento_compra" value="compra"
                                                   {{ $cardex->tipo_movimiento == 'compra' ? 'checked' : '' }}>
                                            <label class="form-check-label movement-label compra" for="movimiento_compra">
                                                <i class="fas fa-arrow-up me-2"></i>Compra (Entrada)
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline flex-grow-1">
                                            <input class="form-check-input" type="radio" name="tipo_movimiento"
                                                   id="movimiento_venta" value="venta"
                                                   {{ $cardex->tipo_movimiento == 'venta' ? 'checked' : '' }}>
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
                                               value="{{ old('cantidad', $cardex->cantidad) }}"
                                               min="1"
                                               required>
                                        <span class="input-group-text bg-dark text-white border-accent">unidades</span>
                                    </div>
                                    <div id="cantidadHelp" class="form-text text-warning"></div>
                                    @error('cantidad')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Preview del Movimiento -->
                                <div class="movement-preview p-4 rounded-3"
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
                                            <div class="col-6 text-end" id="previewMovimiento">0</div>
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
                            <button type="submit" class="btn btn-lg btn-warning">
                                <i class="fas fa-save me-2"></i>Actualizar Movimiento
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
    const cantidadHelp = document.getElementById('cantidadHelp');
    const submitBtn = document.querySelector('button[type="submit"]');

    // Preview elements
    const previewStockActual = document.getElementById('previewStockActual');
    const previewMovimiento = document.getElementById('previewMovimiento');
    const previewStockFinal = document.getElementById('previewStockFinal');

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

    productoSelect.addEventListener('change', actualizarPreview);
    cantidad.addEventListener('input', actualizarPreview);
    tipoMovimiento.forEach(radio => {
        radio.addEventListener('change', actualizarPreview);
    });

    // Inicializar preview
    actualizarPreview();
});
</script>
@endsection
