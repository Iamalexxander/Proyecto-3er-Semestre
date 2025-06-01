@extends('layouts.app2')

@section('title', 'Ubicación - NightFox')

@section('content')
<div class="ubicacion-container">
    <!-- Banner de Ubicación -->
    <div class="ubicacion-banner text-center mb-5 p-5 rounded" style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('{{ asset('images/ubicacion-banner.jpg') }}') center/cover; border: 2px solid var(--accent-color);">
        <h1 class="display-4 mb-3" style="font-family: 'Playfair Display', serif; color: var(--accent-color);">
            Nuestra Ubicación
        </h1>
        <p class="lead text-white">Encuéntranos en el corazón de Chillogallo</p>
    </div>

    <div class="row g-4">
        <!-- Mapa y Dirección -->
        <div class="col-lg-8">
            <div class="card mb-4" style="background: rgba(30, 41, 59, 0.8); border: 1px solid var(--accent-color);">
                <div class="card-body p-4">
                    <h3 class="mb-4" style="color: var(--accent-color);">Cómo Llegar</h3>

                    <!-- Mapa de Google -->
                    <div class="map-container mb-4" style="height: 400px;">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15959.405087302487!2d-78.56577221843262!3d-0.28536089999999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91d598e033c32dfb%3A0x76aa291b922460c5!2sChillogallo%2C%20Quito%20170146!5e0!3m2!1ses!2sec!4v1706061144400!5m2!1ses!2sec"
                            width="100%"
                            height="100%"
                            style="border: 2px solid var(--accent-color); border-radius: 10px;"
                            allowfullscreen=""
                            loading="lazy">
                        </iframe>
                    </div>

                    <!-- Instrucciones de llegada -->
                    <div class="direcciones p-4 rounded" style="background: rgba(15, 23, 42, 0.5); border: 1px solid var(--accent-color);">
                        <h4 class="mb-3" style="color: var(--accent-color);">Direcciones</h4>
                        <ul class="list-unstyled text-white">
                            <li class="mb-3">
                                <i class="fas fa-bus me-2" style="color: var(--accent-color);"></i>
                                <strong>En bus:</strong> Tomar las líneas que van hacia Chillogallo. Bajarse en la parada principal.
                            </li>
                            <li class="mb-3">
                                <i class="fas fa-car me-2" style="color: var(--accent-color);"></i>
                                <strong>En auto:</strong> Desde el centro de Quito, tomar la Av. Mariscal Sucre hacia el sur.
                            </li>
                            <li class="mb-3">
                                <i class="fas fa-subway me-2" style="color: var(--accent-color);"></i>
                                <strong>En Metro:</strong> Estación más cercana a 10 minutos caminando.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Información Adicional -->
        <div class="col-lg-4">
            <!-- Datos de Contacto -->
            <div class="card mb-4" style="background: rgba(30, 41, 59, 0.8); border: 1px solid var(--accent-color);">
                <div class="card-body">
                    <h4 class="card-title mb-3" style="color: var(--accent-color);">Información de Contacto</h4>
                    <ul class="list-unstyled text-white">
                        <li class="mb-3">
                            <i class="fas fa-map-marker-alt me-2" style="color: var(--accent-color);"></i>
                            Chillogallo, Quito, Ecuador
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-phone me-2" style="color: var(--accent-color);"></i>
                            0987279918
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-envelope me-2" style="color: var(--accent-color);"></i>
                            yohelitoalex79@gmail.com
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Horarios -->
            <div class="card mb-4" style="background: rgba(30, 41, 59, 0.8); border: 1px solid var(--accent-color);">
                <div class="card-body">
                    <h4 class="card-title mb-3" style="color: var(--accent-color);">Horarios de Atención</h4>
                    <ul class="list-unstyled text-white">
                        <li class="mb-2"><i class="fas fa-clock me-2" style="color: var(--accent-color);"></i>Lunes - Jueves: 18:00 - 02:00</li>
                        <li class="mb-2"><i class="fas fa-clock me-2" style="color: var(--accent-color);"></i>Viernes: 18:00 - 04:00</li>
                        <li class="mb-2"><i class="fas fa-clock me-2" style="color: var(--accent-color);"></i>Sábado: 19:00 - 04:00</li>
                        <li><i class="fas fa-clock me-2" style="color: var(--accent-color);"></i>Domingo: 18:00 - 00:00</li>
                    </ul>
                </div>
            </div>

            <!-- Tips para visitantes -->
            <div class="card" style="background: rgba(30, 41, 59, 0.8); border: 1px solid var(--accent-color);">
                <div class="card-body">
                    <h4 class="card-title mb-3" style="color: var(--accent-color);">Tips para Visitantes</h4>
                    <ul class="list-unstyled text-white">
                        <li class="mb-2">
                            <i class="fas fa-parking me-2" style="color: var(--accent-color);"></i>
                            Parqueadero disponible
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-taxi me-2" style="color: var(--accent-color);"></i>
                            Servicio de taxi seguro
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-shield-alt me-2" style="color: var(--accent-color);"></i>
                            Zona vigilada 24/7
                        </li>
                        <li>
                            <i class="fas fa-wheelchair me-2" style="color: var(--accent-color);"></i>
                            Acceso para discapacitados
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Zona de Preguntas Frecuentes -->
    <div class="card mt-4 mb-4" style="background: rgba(30, 41, 59, 0.8); border: 1px solid var(--accent-color);">
        <div class="card-body p-4">
            <h3 class="mb-4" style="color: var(--accent-color);">Preguntas Frecuentes</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <h5 class="text-white"><i class="fas fa-question-circle me-2" style="color: var(--accent-color);"></i>¿Hay estacionamiento cercano?</h5>
                        <p class="text-white">Sí, contamos con estacionamiento privado para nuestros clientes.</p>
                    </div>
                    <div class="mb-3">
                        <h5 class="text-white"><i class="fas fa-question-circle me-2" style="color: var(--accent-color);"></i>¿Es segura la zona?</h5>
                        <p class="text-white">La zona cuenta con vigilancia privada y cámaras de seguridad 24/7.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <h5 class="text-white"><i class="fas fa-question-circle me-2" style="color: var(--accent-color);"></i>¿Hay transporte público cercano?</h5>
                        <p class="text-white">Sí, tenemos paradas de bus a menos de 100 metros.</p>
                    </div>
                    <div class="mb-3">
                        <h5 class="text-white"><i class="fas fa-question-circle me-2" style="color: var(--accent-color);"></i>¿Necesito reservar?</h5>
                        <p class="text-white">Se recomienda reservar para grupos grandes o eventos especiales.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
