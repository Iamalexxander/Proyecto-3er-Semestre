@extends('layouts.app2')

@section('content')
    <div class="container mt-4">
        <!-- Cabecera de Productos -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-white mb-0 display-6 fw-bold">
                <i class="fas fa-store-alt me-2 text-warning"></i>Nuestros Productos
            </h2>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-light" data-bs-toggle="tooltip" title="Vista de Grid">
                    <i class="fas fa-th"></i>
                </button>
                <button class="btn btn-outline-light" data-bs-toggle="tooltip" title="Vista de Lista">
                    <i class="fas fa-list"></i>
                </button>
            </div>
        </div>

        <!-- Panel de Filtros -->
        <div class="card border-0 rounded-3xl shadow-lg mb-4"
            style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px);">
            <div class="card-body p-4">
                <form action="{{ route('usuarios.productos.index') }}" method="GET" class="row g-3">
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-0 text-warning">
                                <i class="fas fa-tags"></i>
                            </span>
                            <select class="form-select bg-transparent text-white border-0 border-bottom" name="categoria"
                                id="categoria" style="border-radius: 0;">
                                <option value="" class="text-white">Todas las categorías</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}"
                                        {{ request('categoria') == $categoria->id ? 'selected' : '' }} class="text-white">
                                        {{ $categoria->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-0 text-warning">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" class="form-control bg-transparent text-white border-0 border-bottom"
                                name="buscar" placeholder="Buscar productos..." value="{{ request('buscar') }}"
                                style="border-radius: 0;">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-0 text-warning">
                                <i class="fas fa-sort"></i>
                            </span>
                            <select class="form-select bg-transparent text-white border-0 border-bottom" name="ordenar"
                                style="border-radius: 0;">
                                <option value="reciente" {{ request('ordenar') == 'reciente' ? 'selected' : '' }}
                                    class="text-white">
                                    Más recientes
                                </option>
                                <option value="precio_asc" {{ request('ordenar') == 'precio_asc' ? 'selected' : '' }}
                                    class="text-white">
                                    Precio: Menor a Mayor
                                </option>
                                <option value="precio_desc" {{ request('ordenar') == 'precio_desc' ? 'selected' : '' }}
                                    class="text-white">
                                    Precio: Mayor a Menor
                                </option>
                                <option value="nombre" {{ request('ordenar') == 'nombre' ? 'selected' : '' }}
                                    class="text-white">
                                    Nombre
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-warning w-100">
                            <i class="fas fa-filter me-2"></i>Aplicar filtros
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Grid de Productos -->
        <div class="row g-4">
            @foreach ($productos as $producto)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 border-0 rounded-3xl shadow-lg producto-card overflow-hidden"
                        style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px);">
                        <!-- Imagen del Producto -->
                        <div class="position-relative product-image-container">
                            <img src="{{ asset($producto->imagen) }}" class="card-img-top object-cover h-64"
                                alt="{{ $producto->nombre }}" onerror="this.src='{{ asset('images/placeholder.jpg') }}'">
                            <div class="product-overlay"></div>
                            <div class="position-absolute top-3 start-3 z-10">
                                @if ($producto->cantidad_disponible > 0)
                                    <span class="badge bg-success">En Stock</span>
                                @else
                                    <span class="badge bg-danger">Agotado</span>
                                @endif
                            </div>
                            <button class="btn btn-light rounded-circle position-absolute top-3 end-3 z-10 favorite-btn">
                                <i class="far fa-heart text-danger"></i>
                            </button>
                        </div>

                        <!-- Contenido -->
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <h5 class="card-title text-white mb-1 fw-bold">{{ $producto->nombre }}</h5>
                                <p class="text-warning mb-2">
                                    <i class="fas fa-tag me-1"></i>{{ $producto->categoria->nombre }}
                                </p>
                            </div>

                            <p class="card-text text-white-50 small mb-3">
                                {{ Str::limit($producto->descripcion, 100) }}
                            </p>

                            <!-- Precio -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h4 class="text-warning mb-0">${{ number_format($producto->precio, 2) }}</h4>
                                    @if ($producto->precio_anterior)
                                        <small class="text-decoration-line-through text-white-50">
                                            ${{ number_format($producto->precio_anterior, 2) }}
                                        </small>
                                    @endif
                                </div>
                                <span class="badge bg-info">
                                    <i class="fas fa-boxes me-1"></i>{{ $producto->cantidad_disponible }} unidades
                                </span>
                            </div>

                            <!-- Botones -->
                            <div class="d-grid gap-2">
                                <a href="{{ route('usuarios.productos.show', $producto->id) }}"
                                    class="btn btn-outline-light btn-hover-warning">
                                    <i class="fas fa-eye me-2"></i>Ver detalles
                                </a>
                                <a href="{{ route('usuarios.productos.create', $producto->id) }}"
                                    class="btn btn-warning {{ $producto->cantidad_disponible <= 0 ? 'disabled' : '' }}">
                                    <i class="fas fa-shopping-cart me-2"></i>
                                    {{ $producto->cantidad_disponible > 0 ? 'Agregar al carrito' : 'Agotado' }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

    <style>
        .producto-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .producto-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        }

        .product-image-container {
            height: 250px;
            overflow: hidden;
        }

        .card-img-top {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .producto-card:hover .card-img-top {
            transform: scale(1.1);
        }

        .product-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom,
                    rgba(0, 0, 0, 0.2) 0%,
                    rgba(0, 0, 0, 0.3) 100%);
            pointer-events: none;
        }

        .btn-hover-warning:hover {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
            color: #000;
        }

        .favorite-btn {
            width: 35px;
            height: 35px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            opacity: 0.8;
        }

        .favorite-btn:hover {
            transform: scale(1.1);
            opacity: 1;
        }

        .badge {
            transition: all 0.3s ease;
        }

        .badge:hover {
            transform: scale(1.1);
        }

        .object-cover {
            object-fit: cover;
        }

        .h-64 {
            height: 16rem;
        }

        .z-10 {
            z-index: 10;
        }

        .form-select {
            background-color: rgba(30, 41, 59, 0.8) !important;
            color: white !important;
        }

        .form-select option {
            background-color: rgb(30, 41, 59) !important;
            color: white !important;
            padding: 10px !important;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.5) !important;
        }

        .form-control:focus {
            background-color: rgba(30, 41, 59, 0.8) !important;
            color: white !important;
            box-shadow: none !important;
            border-color: #fbbf24 !important;
        }

        /* Estilo para el dropdown abierto */
        .form-select:focus {
            border-color: #fbbf24 !important;
            box-shadow: none !important;
        }
    </style>

    <script>
        let currentQuantity = 1;
        let maxStock = 0;
        let addToCartModal = null;

        document.addEventListener('DOMContentLoaded', function() {
            // Initialize the modal
            addToCartModal = new bootstrap.Modal(document.getElementById('addToCartModal'), {
                keyboard: true,
                backdrop: true
            });

            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });

            // Handle favorites
            document.querySelectorAll('.favorite-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    this.querySelector('i').classList.toggle('far');
                    this.querySelector('i').classList.toggle('fas');
                });
            });

            // Add form submit handler
            document.getElementById('addToCartForm').addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);

                fetch(this.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        addToCartModal.hide();
                        // Aquí puedes agregar alguna notificación de éxito
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        // Aquí puedes agregar alguna notificación de error
                    });
            });

            // Add modal hidden event listener
            document.getElementById('addToCartModal').addEventListener('hidden.bs.modal', function() {
                currentQuantity = 1;
                document.getElementById('modalQuantity').value = '1';
                document.getElementById('finalQuantity').value = '1';
            });
        });

        function showAddToCartModal(productId, stock) {
            maxStock = stock;
            currentQuantity = 1;

            // Update modal information
            document.getElementById('stockInfo').textContent = `Stock disponible: ${stock}`;
            document.getElementById('modalQuantity').value = '1';
            document.getElementById('finalQuantity').value = '1';

            // Update form action
            document.getElementById('addToCartForm').action = `/carrito/agregar/${productId}`;

            // Show modal
            if (addToCartModal) {
                addToCartModal.show();
            }
        }

        function incrementModalQuantity() {
            if (currentQuantity < maxStock) {
                currentQuantity++;
                updateQuantityDisplays();
            }
        }

        function decrementModalQuantity() {
            if (currentQuantity > 1) {
                currentQuantity--;
                updateQuantityDisplays();
            }
        }

        function updateQuantityDisplays() {
            document.getElementById('modalQuantity').value = currentQuantity;
            document.getElementById('finalQuantity').value = currentQuantity;
        }
    </script>
@endsection
