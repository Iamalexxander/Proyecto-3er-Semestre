@extends('layouts.app2')

@section('title', 'Eventos - NightFox')

@section('content')
    <div class="eventos-container">
        <!-- Banner de Eventos -->
        <div class="eventos-banner text-center mb-5 p-5 rounded"
            style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('{{ asset('images/eventos-banner.jpg') }}') center/cover; border: 2px solid var(--accent-color);">
            <h1 class="display-4 mb-3" style="font-family: 'Playfair Display', serif; color: var(--accent-color);">
                Eventos NightFox
            </h1>
            <p class="lead text-white">Descubre las mejores noches en el corazón de la ciudad</p>
        </div>

        <!-- Eventos Destacados -->
        <div class="eventos-destacados mb-5">
            <h2 class="text-center mb-4" style="color: var(--accent-color);">Próximos Eventos</h2>

            <div class="row g-4">
                <!-- Evento 1 -->
                <div class="col-md-4">
                    <div class="card h-100"
                        style="background: rgba(30, 41, 59, 0.8); border: 1px solid var(--accent-color);">
                        <div class="card-body">
                            <div class="evento-fecha mb-3 text-center" style="color: var(--accent-color);">
                                <i class="fas fa-calendar-alt fa-2x mb-2"></i>
                                <h5>26 Enero 2025</h5>
                            </div>
                            <h4 class="card-title text-center text-white">Noche de Cocktails Exóticos</h4>
                            <p class="card-text text-white">Degustación de cocteles únicos creados por nuestros mixólogos
                                expertos. Música en vivo y sorpresas toda la noche.</p>
                            <ul class="list-unstyled text-white">
                                <li><i class="fas fa-clock me-2" style="color: var(--accent-color);"></i>20:00 - 02:00</li>
                                <li><i class="fas fa-ticket-alt me-2" style="color: var(--accent-color);"></i>Entrada: $15
                                </li>
                            </ul>
                            <div class="text-center">
                                <a href="{{ route('reservas') }}">
                                    <button class="btn">Información de Reservas</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Evento 2 -->
                <div class="col-md-4">
                    <div class="card h-100"
                        style="background: rgba(30, 41, 59, 0.8); border: 1px solid var(--accent-color);">
                        <div class="card-body">
                            <div class="evento-fecha mb-3 text-center" style="color: var(--accent-color);">
                                <i class="fas fa-calendar-alt fa-2x mb-2"></i>
                                <h5>2 Febrero 2025</h5>
                            </div>
                            <h4 class="card-title text-center text-white">DJ Night - Electronic Vibes</h4>
                            <p class="card-text text-white">Una noche llena de la mejor música electrónica con DJ invitados
                                internacionales y efectos visuales espectaculares.</p>
                            <ul class="list-unstyled text-white">
                                <li><i class="fas fa-clock me-2" style="color: var(--accent-color);"></i>22:00 - 04:00</li>
                                <li><i class="fas fa-ticket-alt me-2" style="color: var(--accent-color);"></i>Entrada: $20
                                </li>
                            </ul>
                            <div class="text-center">
                                <a href="{{ route('reservas') }}">
                                    <button class="btn">Información de Reservas</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Evento 3 -->
                <div class="col-md-4">
                    <div class="card h-100"
                        style="background: rgba(30, 41, 59, 0.8); border: 1px solid var(--accent-color);">
                        <div class="card-body">
                            <div class="evento-fecha mb-3 text-center" style="color: var(--accent-color);">
                                <i class="fas fa-calendar-alt fa-2x mb-2"></i>
                                <h5>14 Febrero 2025</h5>
                            </div>
                            <h4 class="card-title text-center text-white">San Valentín en NightFox</h4>
                            <p class="card-text text-white">Celebra el amor con una noche especial que incluye cena
                                romántica, cocteles especiales y música en vivo.</p>
                            <ul class="list-unstyled text-white">
                                <li><i class="fas fa-clock me-2" style="color: var(--accent-color);"></i>19:00 - 02:00</li>
                                <li><i class="fas fa-ticket-alt me-2" style="color: var(--accent-color);"></i>Entrada:
                                    $30/pareja</li>
                            </ul>
                            <div class="text-center">
                                <a href="{{ route('reservas') }}">
                                    <button class="btn">Información de Reservas</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Calendario Mensual -->
        <div class="calendario-eventos mb-5">
            <h2 class="text-center mb-4" style="color: var(--accent-color);">Calendario de Eventos</h2>
            <div class="table-responsive">
                <table class="table table-dark table-hover"
                    style="background: rgba(30, 41, 59, 0.8); border: 1px solid var(--accent-color);">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Evento</th>
                            <th>Horario</th>
                            <th>Descripción</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>19 Enero</td>
                            <td>Noche de Salsa</td>
                            <td>21:00 - 03:00</td>
                            <td>Clases de baile y música en vivo</td>
                            <td>$10</td>
                        </tr>
                        <tr>
                            <td>26 Enero</td>
                            <td>Cocktails Exóticos</td>
                            <td>20:00 - 02:00</td>
                            <td>Degustación de cocteles especiales</td>
                            <td>$15</td>
                        </tr>
                        <tr>
                            <td>2 Febrero</td>
                            <td>DJ Night</td>
                            <td>22:00 - 04:00</td>
                            <td>Música electrónica</td>
                            <td>$20</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
