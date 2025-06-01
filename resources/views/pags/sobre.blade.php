@extends('layouts.app2')

@section('title', 'Sobre Nosotros - NightFox')

@section('content')
<div class="row g-4">
    <!-- Sección Hero -->
    <div class="col-12 text-center mb-5">
        <h1 class="display-4 fw-bold" style="color: var(--accent-color);">
            <i class="fas fa-fox me-2"></i>NightFox
        </h1>
        <p class="lead text-white">Tu destino nocturno favorito, ahora en línea</p>
        <div class="border-bottom border-warning my-4"></div>
    </div>

    <!-- Historia -->
    <div class="col-12 mb-5">
        <div class="p-4 rounded-3" style="background: rgba(15, 23, 42, 0.5);">
            <h2 class="h3 mb-4" style="color: var(--accent-color);">
                <i class="fas fa-history me-2"></i>Nuestra Historia
            </h2>
            <p class="text-white">
                NightFox nació en 2023 con una visión revolucionaria: llevar la experiencia de un bar premium directamente a tu hogar. Comenzamos como un pequeño emprendimiento local y rápidamente nos convertimos en el referente de la distribución de bebidas premium en línea.
            </p>
            <p class="text-white">
                Nuestra pasión por ofrecer las mejores bebidas y un servicio excepcional nos ha permitido crear una comunidad vibrante de amantes de la buena bebida.
            </p>
        </div>
    </div>

    <!-- Misión y Visión -->
    <div class="col-md-6">
        <div class="h-100 p-4 rounded-3" style="background: rgba(15, 23, 42, 0.5);">
            <h2 class="h3 mb-4" style="color: var(--accent-color);">
                <i class="fas fa-bullseye me-2"></i>Misión
            </h2>
            <p class="text-white">
                Proporcionar a nuestros clientes la más amplia selección de bebidas premium y licores de alta calidad, garantizando una experiencia de compra segura y conveniente desde la comodidad de su hogar.
            </p>
        </div>
    </div>

    <div class="col-md-6">
        <div class="h-100 p-4 rounded-3" style="background: rgba(15, 23, 42, 0.5);">
            <h2 class="h3 mb-4" style="color: var(--accent-color);">
                <i class="fas fa-eye me-2"></i>Visión
            </h2>
            <p class="text-white">
                Ser reconocidos como el principal marketplace de bebidas alcohólicas premium en línea, destacando por nuestra innovación, calidad de servicio y compromiso con la satisfacción del cliente.
            </p>
        </div>
    </div>

    <!-- Por qué elegirnos -->
    <div class="col-12 mt-4">
        <div class="p-4 rounded-3" style="background: rgba(15, 23, 42, 0.5);">
            <h2 class="h3 mb-4" style="color: var(--accent-color);">
                <i class="fas fa-star me-2"></i>¿Por qué elegir NightFox?
            </h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="text-center p-3">
                        <i class="fas fa-check-circle fa-2x mb-3" style="color: var(--accent-color);"></i>
                        <h3 class="h5 text-white">Calidad Garantizada</h3>
                        <p class="text-white-50">Todos nuestros productos son 100% originales y de las mejores marcas.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center p-3">
                        <i class="fas fa-truck fa-2x mb-3" style="color: var(--accent-color);"></i>
                        <h3 class="h5 text-white">Entrega Rápida</h3>
                        <p class="text-white-50">Envíos seguros y rápidos a la puerta de tu casa.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center p-3">
                        <i class="fas fa-user-shield fa-2x mb-3" style="color: var(--accent-color);"></i>
                        <h3 class="h5 text-white">Compra Segura</h3>
                        <p class="text-white-50">Plataforma segura y verificación de edad garantizada.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Equipo -->
    <div class="col-12 mt-4 mb-5">
        <div class="p-4 rounded-3" style="background: rgba(15, 23, 42, 0.5);">
            <h2 class="h3 mb-4" style="color: var(--accent-color);">
                <i class="fas fa-users me-2"></i>Nuestro Compromiso
            </h2>
            <p class="text-white">
                En NightFox, nos comprometemos a:
            </p>
            <ul class="text-white">
                <li class="mb-2">Verificar rigurosamente la edad de nuestros clientes</li>
                <li class="mb-2">Promover el consumo responsable de alcohol</li>
                <li class="mb-2">Mantener los más altos estándares de calidad en nuestros productos</li>
                <li class="mb-2">Ofrecer un servicio al cliente excepcional</li>
                <li>Garantizar la seguridad en todas las transacciones</li>
            </ul>
        </div>
    </div>

    <!-- CTA -->
    <div class="col-12 text-center mb-4">
        <a href="{{ route('usuarios.productos.index') }}" class="btn btn-lg">
            <i class="fas fa-shopping-bag me-2"></i>Explorar Productos
        </a>
    </div>
</div>
@endsection
