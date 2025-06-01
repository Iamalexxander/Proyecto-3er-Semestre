@extends('layouts.app2')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container mt-4">
    <div class="card border-0 shadow-2xl" style="background: rgba(15, 23, 42, 0.97); backdrop-filter: blur(20px);">
        <div class="card-body p-5">
            <h2 class="mb-5 d-flex align-items-center gap-3" style="color: var(--accent-color); font-family: 'Playfair Display', serif; font-size: 2.5rem;">
                <i class="fas fa-shopping-cart fa-lg"></i>
                <span>Tu Carrito de Compras</span>
            </h2>

            @if(session('cart'))
                <div class="row g-4">
                    <div class="col-lg-8">
                        @foreach(session('cart') as $id => $detalles)
                            @php
                                $producto = App\Models\Producto::find($id);
                                $stockDisponible = $producto ? $producto->cantidad_disponible : 0;
                            @endphp
                            <div class="card mb-4 border-0 product-card"
                                 style="background: rgba(30, 41, 59, 0.98); transition: all 0.3s ease;">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <div class="position-relative h-100 overflow-hidden rounded-start">
                                            <img src="{{ asset($detalles['imagen']) }}"
                                                 class="img-fluid w-100 h-100 object-fit-cover transform-image"
                                                 alt="{{ $detalles['nombre'] }}"
                                                 style="max-height: 220px;">
                                            <div class="position-absolute top-0 end-0 m-3">
                                                <span class="badge product-badge cantidad-badge-{{ $id }}">
                                                    {{ $detalles['cantidad'] }} unid.
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body p-4">
                                            <h5 class="product-title mb-3">
                                                {{ $detalles['nombre'] }}
                                            </h5>
                                            <p class="price-tag mb-4">
                                                ${{ number_format($detalles['precio'], 2) }}
                                            </p>
                                            <div class="d-flex flex-wrap gap-3 align-items-center">
                                                <div class="quantity-control">
                                                    <button type="button" class="btn-quantity"
                                                            onclick="decrementQuantity({{ $id }})">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <input type="number"
                                                           class="quantity-input"
                                                           id="cantidad-{{ $id }}"
                                                           value="{{ $detalles['cantidad'] }}"
                                                           min="1"
                                                           max="{{ $stockDisponible }}"
                                                           data-producto-id="{{ $id }}"
                                                           readonly>
                                                    <button type="button" class="btn-quantity"
                                                            onclick="incrementQuantity({{ $id }}, {{ $stockDisponible }})">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                                <small class="text-warning">Stock disponible: {{ $stockDisponible }}</small>
                                                <form action="{{ route('carrito.eliminar') }}" method="POST" class="ms-auto">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $id }}">
                                                    <button type="submit" class="btn-remove">
                                                        <i class="fas fa-trash-alt me-2"></i>Eliminar
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-lg-4">
                        <div class="card border-0 summary-card">
                            <div class="card-body p-4">
                                <h5 class="summary-title mb-4">
                                    Resumen de la Compra
                                </h5>
                                @php $total = 0 @endphp
                                @foreach(session('cart') as $id => $detalles)
                                    @php $total += $detalles['precio'] * $detalles['cantidad'] @endphp
                                    <div class="summary-item" id="summary-item-{{ $id }}">
                                        <span>{{ $detalles['nombre'] }} (x<span class="cantidad-resumen-{{ $id }}">{{ $detalles['cantidad'] }}</span>)</span>
                                        <span class="subtotal-{{ $id }}">${{ number_format($detalles['precio'] * $detalles['cantidad'], 2) }}</span>
                                    </div>
                                @endforeach
                                <hr class="summary-divider">
                                <div class="total-section">
                                    <span>Total Final</span>
                                    <span class="total-amount" id="total-final">${{ number_format($total, 2) }}</span>
                                </div>
                                <form action="{{ route('carrito.procesar') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-checkout">
                                        <i class="fas fa-lock me-2"></i>Proceder al Pago
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="empty-cart">
                    <div class="empty-cart-icon">
                        <i class="fas fa-shopping-basket"></i>
                    </div>
                    <h3>Tu carrito está vacío</h3>
                    <p>¡Descubre nuestra increíble selección de productos!</p>
                    <a href="{{ route('usuarios.productos.index') }}" class="btn-explore">
                        <i class="fas fa-store me-2"></i>Explorar Tienda
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
function actualizarCarrito(productoId, cantidad) {
    fetch(`/carrito/actualizar/${productoId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ cantidad: cantidad })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            actualizarPreciosCarrito();
        }
    });
}

function actualizarPreciosCarrito() {
    let total = 0;
    document.querySelectorAll('.quantity-input').forEach(input => {
        const productoId = input.dataset.productoId;
        const cantidad = parseInt(input.value);
        const precio = parseFloat(input.closest('.card').querySelector('.price-tag').textContent.replace('$', ''));
        const subtotal = cantidad * precio;

        document.querySelector(`.cantidad-badge-${productoId}`).textContent = `${cantidad} unid.`;
        document.querySelector(`.cantidad-resumen-${productoId}`).textContent = cantidad;
        document.querySelector(`.subtotal-${productoId}`).textContent = `$${subtotal.toFixed(2)}`;

        total += subtotal;
    });

    document.getElementById('total-final').textContent = `$${total.toFixed(2)}`;
}

function incrementQuantity(productoId, maxStock) {
    const input = document.getElementById(`cantidad-${productoId}`);
    const currentValue = parseInt(input.value);

    if (currentValue < maxStock) {
        input.value = currentValue + 1;
        actualizarCarrito(productoId, currentValue + 1);
        actualizarPreciosCarrito();
    }
}

function decrementQuantity(productoId) {
    const input = document.getElementById(`cantidad-${productoId}`);
    const currentValue = parseInt(input.value);

    if (currentValue > 1) {
        input.value = currentValue - 1;
        actualizarCarrito(productoId, currentValue - 1);
        actualizarPreciosCarrito();
    }
}
</script>

<style>
    .product-card {
        border-radius: 1rem;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
    }

    .transform-image {
        transition: all 0.5s ease;
    }

    .product-card:hover .transform-image {
        transform: scale(1.05);
    }

    .product-badge {
        background: linear-gradient(135deg, var(--accent-color), var(--accent-color2));
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
        border-radius: 2rem;
    }

    .product-title {
        color: var(--accent-color);
        font-size: 1.5rem;
        font-weight: 600;
        font-family: 'Playfair Display', serif;
    }

    .price-tag {
        color: white;
        font-size: 2rem;
        font-weight: 700;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    .quantity-control {
        display: flex;
        align-items: center;
        background: rgba(15, 23, 42, 0.8);
        border-radius: 2rem;
        padding: 0.25rem;
        border: 2px solid var(--accent-color);
    }

    .btn-quantity {
        background: transparent;
        border: none;
        color: var(--accent-color);
        padding: 0.5rem 1rem;
        transition: all 0.3s ease;
    }

    .btn-quantity:hover {
        color: white;
        background: var(--accent-color);
    }

    .quantity-input {
        width: 60px;
        text-align: center;
        background: transparent;
        border: none;
        color: white;
        font-weight: 600;
    }

    .btn-remove {
        background: linear-gradient(135deg, #dc2626, #991b1b);
        border: none;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 2rem;
        transition: all 0.3s ease;
    }

    .btn-remove:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(220, 38, 38, 0.4);
    }

    .summary-card {
        background: rgba(30, 41, 59, 0.98);
        border-radius: 1rem;
        position: sticky;
        top: 2rem;
    }

    .summary-title {
        color: var(--accent-color);
        font-size: 1.5rem;
        font-weight: 600;
        font-family: 'Playfair Display', serif;
    }

    .summary-item {
        display: flex;
        justify-content: space-between;
        color: rgba(255, 255, 255, 0.7);
        margin-bottom: 1rem;
        font-size: 0.95rem;
    }

    .summary-divider {
        border-color: var(--accent-color);
        opacity: 0.2;
        margin: 1.5rem 0;
    }

    .total-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .total-amount {
        color: var(--accent-color);
        font-size: 2rem;
        font-weight: 700;
    }

    .btn-checkout {
        width: 100%;
        padding: 1rem;
        border: none;
        border-radius: 2rem;
        background: linear-gradient(135deg, var(--accent-color), var(--accent-color2));
        color: white;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
    }

    .btn-checkout:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(245, 158, 11, 0.4);
    }

    .empty-cart {
        text-align: center;
        padding: 4rem 2rem;
    }

    .empty-cart-icon {
        font-size: 5rem;
        color: var(--accent-color);
        margin-bottom: 2rem;
        opacity: 0.8;
    }

    .empty-cart h3 {
        color: white;
        font-size: 2rem;
        margin-bottom: 1rem;
        font-family: 'Playfair Display', serif;
    }

    .empty-cart p {
        color: rgba(255, 255, 255, 0.7);
        margin-bottom: 2rem;
    }

    .btn-explore {
        display: inline-block;
        padding: 1rem 2rem;
        background: linear-gradient(135deg, var(--accent-color), var(--accent-color2));
        color: white;
        text-decoration: none;
        border-radius: 2rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-explore:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(245, 158, 11, 0.4);
        color: white;
    }

    @media (max-width: 768px) {
        .product-card .row {
            flex-direction: column;
        }

        .product-card .col-md-4 {
            max-height: 200px;
        }

        .quantity-control {
            width: 100%;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .btn-remove {
            width: 100%;
        }
    }
</style>
@endsection
