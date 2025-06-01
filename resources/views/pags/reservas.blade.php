@extends('layouts.app2')

@section('title', 'Reservas - NightFox')

@section('content')
<div class="reservas-container">
    <!-- Banner de Reservas -->
    <div class="reservas-banner text-center mb-5 p-5 rounded" style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('{{ asset('images/reservas-banner.jpg') }}') center/cover; border: 2px solid var(--accent-color);">
        <h1 class="display-4 mb-3" style="font-family: 'Playfair Display', serif; color: var(--accent-color);">
            Información de Reservas
        </h1>
        <p class="lead text-white">Conoce cómo puedes reservar tu espacio en NightFox</p>
    </div>

    <div class="row g-4">
        <!-- Información Principal de Reservas -->
        <div class="col-lg-8">
            <div class="card mb-4" style="background: rgba(30, 41, 59, 0.8); border: 1px solid var(--accent-color);">
                <div class="card-body p-4">
                    <h3 class="card-title mb-4" style="color: var(--accent-color);">¿Cómo Realizar una Reserva?</h3>

                    <!-- Métodos de Reserva -->
                    <div class="mb-4">
                        <h4 class="text-white mb-3">Canales de Reserva</h4>
                        <ul class="list-unstyled text-white">
                            <li class="mb-3">
                                <i class="fas fa-phone-alt me-2" style="color: var(--accent-color);"></i>
                                <strong>Por teléfono:</strong> Llama al 0987279918 (disponible de 10:00 a 22:00)
                            </li>
                            <li class="mb-3">
                                <i class="fab fa-whatsapp me-2" style="color: var(--accent-color);"></i>
                                <strong>WhatsApp:</strong> Mensaje al 0987279918
                            </li>
                            <li class="mb-3">
                                <i class="fas fa-envelope me-2" style="color: var(--accent-color);"></i>
                                <strong>Email:</strong> yohelitoalex79@gmail.com
                            </li>
                        </ul>
                    </div>

                    <!-- Información Importante -->
                    <div class="mb-4">
                        <h4 class="text-white mb-3">Información Importante</h4>
                        <div class="p-3 rounded" style="background: rgba(15, 23, 42, 0.5);">
                            <ul class="text-white">
                                <li class="mb-2">Se recomienda realizar la reserva con al menos 24 horas de anticipación</li>
                                <li class="mb-2">Para grupos de más de 8 personas, es necesario realizar la reserva con 48 horas de anticipación</li>
                                <li class="mb-2">Todas las reservas están sujetas a disponibilidad</li>
                                <li class="mb-2">Se requiere un número de contacto válido para confirmar la reserva</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Tipos de Reservas -->
                    <div class="mb-4">
                        <h4 class="text-white mb-3">Tipos de Reservas Disponibles</h4>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="p-3 rounded" style="background: rgba(15, 23, 42, 0.5);">
                                    <h5 style="color: var(--accent-color);">Mesas Regulares</h5>
                                    <ul class="text-white">
                                        <li>Capacidad: 2-6 personas</li>
                                        <li>Ubicación en área general</li>
                                        <li>Servicio de mesero regular</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 rounded" style="background: rgba(15, 23, 42, 0.5);">
                                    <h5 style="color: var(--accent-color);">Área VIP</h5>
                                    <ul class="text-white">
                                        <li>Capacidad: 6-12 personas</li>
                                        <li>Ubicación privilegiada</li>
                                        <li>Servicio personalizado</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Información Adicional -->
        <div class="col-lg-4">
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

            <!-- Políticas -->
            <div class="card mb-4" style="background: rgba(30, 41, 59, 0.8); border: 1px solid var(--accent-color);">
                <div class="card-body">
                    <h4 class="card-title mb-3" style="color: var(--accent-color);">Políticas de Reserva</h4>
                    <ul class="list-unstyled text-white">
                        <li class="mb-2"><i class="fas fa-info-circle me-2" style="color: var(--accent-color);"></i>Se requiere confirmación previa</li>
                        <li class="mb-2"><i class="fas fa-clock me-2" style="color: var(--accent-color);"></i>Tolerancia de 15 minutos</li>
                        <li class="mb-2"><i class="fas fa-ban me-2" style="color: var(--accent-color);"></i>Cancelación con 24h de anticipación</li>
                        <li><i class="fas fa-user-friends me-2" style="color: var(--accent-color);"></i>Dress code: Smart Casual</li>
                    </ul>
                </div>
            </div>

            <!-- Contacto -->
            <div class="card" style="background: rgba(30, 41, 59, 0.8); border: 1px solid var(--accent-color);">
                <div class="card-body">
                    <h4 class="card-title mb-3" style="color: var(--accent-color);">Contacto Directo</h4>
                    <ul class="list-unstyled text-white">
                        <li class="mb-2"><i class="fas fa-phone me-2" style="color: var(--accent-color);"></i>0987279918</li>
                        <li class="mb-2"><i class="fas fa-envelope me-2" style="color: var(--accent-color);"></i>yohelitoalex79@gmail.com</li>
                        <li><i class="fas fa-map-marker-alt me-2" style="color: var(--accent-color);"></i>Chillogallo, Quito</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
