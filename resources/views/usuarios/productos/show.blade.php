
@extends('layouts.app2')

@section('content')
<div class="container mt-4">
    <div class="card border-0 shadow-2xl rounded-3xl overflow-hidden"
         style="background: rgba(15, 23, 42, 0.95); backdrop-filter: blur(20px);">
        <div class="card-body p-0">
            <!-- Navegación de Regreso -->
            <div class="p-4 border-bottom" style="border-color: rgba(245, 158, 11, 0.1) !important;">
                <a href="{{ route('usuarios.productos.index') }}" class="text-warning text-decoration-none">
                    <i class="fas fa-arrow-left me-2"></i>Volver a Productos
                </a>
            </div>

            <div class="row g-0">
                <!-- Galería de Imágenes -->
                <div class="col-lg-6">
                    <div class="position-relative h-100">
                        <div class="position-relative overflow-hidden" style="height: 500px;">
                            <img src="{{ asset($producto->imagen) }}"
                                 class="w-100 h-100 object-fit-cover"
                                 alt="{{ $producto->nombre }}"
                                 id="mainImage">

                            <!-- Badges -->
                            <div class="position-absolute top-4 start-4 d-flex gap-2">
                                @if($producto->cantidad_disponible > 0)
                                    <span class="badge bg-success rounded-pill px-3 py-2">
                                        <i class="fas fa-check-circle me-1"></i>En Stock
                                    </span>
                                @else
                                    <span class="badge bg-danger rounded-pill px-3 py-2">
                                        <i class="fas fa-times-circle me-1"></i>Agotado
                                    </span>
                                @endif
                                @if($producto->es_nuevo)
                                    <span class="badge rounded-pill px-3 py-2"
                                          style="background: linear-gradient(45deg, var(--accent-color), var(--accent-color2))">
                                        <i class="fas fa-star me-1"></i>Nuevo
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Miniaturas -->
                        <div class="d-flex gap-2 p-4">
                            @foreach($producto->imagenes ?? [] as $imagen)
                            <div class="thumbnail-container" style="width: 80px; height: 80px;">
                                <img src="{{ asset($imagen->ruta) }}"
                                     class="w-100 h-100 object-fit-cover rounded-3 cursor-pointer thumbnail"
                                     alt="Thumbnail">
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Detalles del Producto -->
                <div class="col-lg-6">
                    <div class="p-5">
                        <div class="mb-4">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <span class="badge bg-info rounded-pill">{{ $producto->categoria->nombre }}</span>
                                <span class="badge bg-secondary rounded-pill">{{ $producto->marca }}</span>
                            </div>
                            <h1 class="text-white mb-2" style="font-family: 'Playfair Display', serif;">
                                {{ $producto->nombre }}
                            </h1>
                            <div class="d-flex align-items-center gap-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-star text-warning me-1"></i>
                                    <span class="text-white">4.8</span>
                                </div>
                                <span class="text-white-50">({{ rand(10, 100) }} reseñas)</span>
                            </div>
                        </div>

                        <!-- Precio -->
                        <div class="mb-4">
                            <div class="d-flex align-items-center gap-3">
                                <h2 class="text-warning mb-0">${{ number_format($producto->precio, 2) }}</h2>
                                @if($producto->precio_anterior)
                                    <span class="text-decoration-line-through text-white-50">
                                        ${{ number_format($producto->precio_anterior, 2) }}
                                    </span>
                                    <span class="badge bg-danger">
                                        {{ round((($producto->precio_anterior - $producto->precio) / $producto->precio_anterior) * 100) }}% OFF
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Descripción -->
                        <div class="mb-4">
                            <h5 class="text-white mb-3">Descripción</h5>
                            <p class="text-white-50">{{ $producto->descripcion }}</p>
                        </div>

                        <!-- Características -->
                        <div class="mb-4">
                            <h5 class="text-white mb-3">Características</h5>
                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="fas fa-box text-warning"></i>
                                        <span class="text-white-50">Stock: {{ $producto->cantidad_disponible }}</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="fas fa-shipping-fast text-warning"></i>
                                        <span class="text-white-50">Envío Gratis</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="fas fa-shield-alt text-warning"></i>
                                        <span class="text-white-50">Garantía</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="fas fa-exchange-alt text-warning"></i>
                                        <span class="text-white-50">Devolución Gratis</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Acciones -->
                        <div class="d-grid gap-3">
                            <div class="d-flex gap-3">
                                <div class="input-group" style="width: 140px;">
                                    <button class="btn btn-outline-warning px-3 rounded-start-pill" type="button">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <input type="text" class="form-control text-center border-warning"
                                           style="background: rgba(15, 23, 42, 0.95); color: white;"
                                           value="1">
                                    <button class="btn btn-outline-warning px-3 rounded-end-pill" type="button">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <button class="btn btn-outline-light flex-shrink-0 rounded-circle"
                                        style="width: 48px; height: 48px;">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>
                            <form action="{{ route('carrito.agregar', $producto->id) }}" method="POST" class="d-grid">
                                @csrf
                                <button type="submit"
                                        class="btn btn-lg rounded-pill {{ $producto->cantidad_disponible <= 0 ? 'disabled' : '' }}"
                                        style="background: linear-gradient(45deg, var(--accent-color), var(--accent-color2));">
                                    <i class="fas fa-shopping-cart me-2"></i>
                                    {{ $producto->cantidad_disponible > 0 ? 'Agregar al Carrito' : 'Agotado' }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección de Productos Relacionados -->
            @if(isset($productosRelacionados) && count($productosRelacionados) > 0)
            <div class="border-top p-5" style="border-color: rgba(245, 158, 11, 0.1) !important;">
                <h3 class="text-white mb-4">Productos Relacionados</h3>
                <div class="row g-4">
                    @foreach($productosRelacionados as $productoRelacionado)
                    <div class="col-md-3">
                        <div class="card h-100 border-0 hover-elevation rounded-3xl overflow-hidden"
                             style="background: rgba(30, 41, 59, 0.95);">
                            <img src="{{ asset($productoRelacionado->imagen) }}"
                                 class="card-img-top"
                                 alt="{{ $productoRelacionado->nombre }}"
                                 style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title text-white">{{ $productoRelacionado->nombre }}</h5>
                                <p class="card-text text-warning">${{ number_format($productoRelacionado->precio, 2) }}</p>
                                <a href="{{ route('usuarios.productos.show', $productoRelacionado->id) }}"
                                   class="btn btn-outline-warning w-100">Ver Detalles</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
    .hover-elevation {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .hover-elevation:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
    }

    .thumbnail {
        transition: all 0.3s ease;
        opacity: 0.6;
    }

    .thumbnail:hover {
        opacity: 1;
        transform: scale(1.05);
    }

    .thumbnail.active {
        opacity: 1;
        border: 2px solid var(--accent-color);
    }

    .cursor-pointer {
        cursor: pointer;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Cambiar imagen principal al hacer clic en miniaturas
    const thumbnails = document.querySelectorAll('.thumbnail');
    const mainImage = document.getElementById('mainImage');

    thumbnails.forEach(thumb => {
        thumb.addEventListener('click', function() {
            mainImage.src = this.src;
            thumbnails.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // Manejar botón de favoritos
    const favButton = document.querySelector('.btn-outline-light');
    favButton.addEventListener('click', function() {
        const icon = this.querySelector('i');
        icon.classList.toggle('far');
        icon.classList.toggle('fas');
        icon.classList.toggle('text-danger');
    });
});
</script>
@endsection
