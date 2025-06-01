@extends('layouts.app2')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card border-0 rounded-4xl shadow-2xl overflow-hidden"
                    style="background: rgba(15, 23, 42, 0.97); backdrop-filter: blur(20px);">

                    <div class="card-header border-0 bg-transparent p-4">
                        <h3 class="mb-0 d-flex align-items-center gap-3"
                            style="color: var(--accent-color); font-family: 'Playfair Display', serif; font-size: 2rem;">
                            <i class="fas fa-cart-plus fa-lg"></i>
                            <span>Agregar al Carrito</span>
                        </h3>
                    </div>

                    <div class="card-body p-4">
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="position-relative h-100">
                                    <div class="product-image-container rounded-4xl overflow-hidden shadow-lg"
                                        style="height: 400px;">
                                        <img src="{{ asset($producto->imagen) }}" class="w-100 h-100"
                                            alt="{{ $producto->nombre }}"
                                            style="object-fit: cover; transition: transform 0.5s ease;">
                                    </div>
                                    <div class="position-absolute top-0 end-0 m-3">
                                        <span class="badge"
                                            style="background: linear-gradient(135deg, var(--accent-color), var(--accent-color2)); padding: 0.5rem 1rem; font-size: 1rem;">
                                            {{ $producto->categoria->nombre }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="product-details p-4"
                                    style="height: 100%; display: flex; flex-direction: column;">
                                    <h4 class="product-title mb-3"
                                        style="color: var(--accent-color); font-family: 'Playfair Display', serif; font-size: 2rem;">
                                        {{ $producto->nombre }}
                                    </h4>

                                    <div class="description-box mb-4 p-3 rounded-3"
                                        style="background: rgba(255, 255, 255, 0.05);">
                                        <p class="mb-0 text-white-50">{{ $producto->descripcion }}</p>
                                    </div>

                                    <div class="price-stock-info mb-4">
                                        <div class="price mb-2 d-flex align-items-center gap-2">
                                            <span class="text-white-50">Precio:</span>
                                            <span class="fs-2 fw-bold" style="color: var(--accent-color);">
                                                ${{ number_format($producto->precio, 2) }}
                                            </span>
                                        </div>

                                        <div class="stock d-flex align-items-center gap-2">
                                            <i class="fas fa-box text-warning"></i>
                                            <span class="text-white-50">Stock disponible:</span>
                                            <span class="text-white">{{ $producto->cantidad_disponible }} unidades</span>
                                        </div>
                                    </div>

                                    <form action="{{ route('carrito.agregar', $producto->id) }}" method="POST"
                                        class="mt-auto">
                                        @csrf
                                        <div class="quantity-selector mb-4">
                                            <label class="text-white-50 mb-2">Cantidad:</label>
                                            <div class="quantity-control d-flex align-items-center justify-content-between gap-3 p-2 rounded-pill"
                                                style="background: rgba(255, 255, 255, 0.05); border: 2px solid var(--accent-color); width: fit-content;">
                                                <!-- Botón de decremento -->
                                                <button type="button" class="btn-quantity" onclick="decrementQuantity()"
                                                    style="width: 50px; height: 40px; border-radius: 50%; background: transparent; border: none; color: var(--accent-color); display: flex; align-items: center; justify-content: center;">
                                                    <i class="fas fa-minus"></i>
                                                </button>

                                                <!-- Input de cantidad -->
                                                <input type="number" name="cantidad" id="cantidad"
                                                    class="form-control text-center bg-transparent text-white border-0"
                                                    value="1" min="1" max="{{ $producto->cantidad_disponible }}"
                                                    readonly
                                                    style="width: 80px; font-size: 1.25rem; font-weight: 600; text-align: center;">

                                                <!-- Botón de incremento -->
                                                <button type="button" class="btn-quantity" onclick="incrementQuantity()"
                                                    style="width: 50px; height: 40px; border-radius: 50%; background: transparent; border: none; color: var(--accent-color); display: flex; align-items: center; justify-content: center;">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="d-grid gap-3">
                                            <button type="submit" class="btn btn-lg"
                                                style="background: linear-gradient(135deg, var(--accent-color), var(--accent-color2)); border: none; font-size: 1.1rem;">
                                                <i class="fas fa-shopping-cart me-2"></i>Agregar al Carrito
                                            </button>
                                            <a href="{{ route('usuarios.productos.index') }}"
                                                class="btn btn-lg btn-outline-light">
                                                <i class="fas fa-arrow-left me-2"></i>Volver a Productos
                                            </a>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .product-image-container:hover img {
            transform: scale(1.05);
        }

        .btn-quantity:hover {
            background: var(--accent-color) !important;
            color: white !important;
        }

        .quantity-control:hover {
            border-color: var(--accent-color2) !important;
        }

        @media (max-width: 991px) {
            .product-details {
                padding: 1rem !important;
            }

            .product-image-container {
                height: 300px !important;
            }
        }
    </style>

    <script>
        function incrementQuantity() {
            const input = document.getElementById('cantidad');
            const maxStock = {{ $producto->cantidad_disponible }};
            const currentValue = parseInt(input.value);

            if (currentValue < maxStock) {
                input.value = currentValue + 1;
            }
        }

        function decrementQuantity() {
            const input = document.getElementById('cantidad');
            const currentValue = parseInt(input.value);

            if (currentValue > 1) {
                input.value = currentValue - 1;
            }
        }
    </script>
@endsection
