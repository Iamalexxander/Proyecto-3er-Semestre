@extends('layouts.app2')

@section('content')
<style>
    .hero-section {
        min-height: 85vh;
        position: relative;
        overflow: hidden;
        padding: 4rem 0;
        background: linear-gradient(135deg, rgba(15, 23, 42, 0.9), rgba(30, 41, 59, 0.9)),
                    url('https://images.unsplash.com/photo-1566417713940-fe7c737a9ef2?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80') center/cover;
    }

    .hero-content {
        animation: fadeInUp 1s ease-out;
    }

    .hero-title {
        font-family: 'Playfair Display', serif;
        font-size: 4rem;
        font-weight: 700;
        line-height: 1.2;
        margin-bottom: 1.5rem;
        background: linear-gradient(45deg, #f59e0b, #b45309);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    .hero-subtitle {
        font-size: 1.25rem;
        line-height: 1.6;
        margin-bottom: 2rem;
        color: #e2e8f0;
    }

    .feature-card {
        background: rgba(30, 41, 59, 0.8);
        border: 1px solid rgba(245, 158, 11, 0.2);
        border-radius: 1rem;
        padding: 2rem;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }

    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        border-color: var(--accent-color);
    }

    .feature-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(45deg, var(--accent-color), var(--accent-color2));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
        font-size: 2rem;
        color: white;
        transition: all 0.3s ease;
    }

    .feature-card:hover .feature-icon {
        transform: rotate(360deg) scale(1.1);
    }

    .special-offers {
        position: relative;
        padding: 4rem 0;
        background: linear-gradient(45deg, rgba(15, 23, 42, 0.9), rgba(30, 41, 59, 0.9));
    }

    .offer-card {
        background: rgba(15, 23, 42, 0.8);
        border: 1px solid rgba(245, 158, 11, 0.2);
        border-radius: 1rem;
        padding: 2rem;
        margin-bottom: 2rem;
        transition: all 0.3s ease;
    }

    .offer-card:hover {
        transform: scale(1.03);
        border-color: var(--accent-color);
    }

    .btn-custom {
        background: linear-gradient(45deg, var(--accent-color), var(--accent-color2));
        color: white;
        padding: 1rem 2rem;
        border-radius: 2rem;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        transition: all 0.3s ease;
        border: none;
        box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
    }

    .btn-custom:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(245, 158, 11, 0.4);
        color: white;
    }

    .stats-section {
        padding: 4rem 0;
        background: linear-gradient(135deg, rgba(15, 23, 42, 0.95), rgba(30, 41, 59, 0.95));
    }

    .stat-card {
        text-align: center;
        padding: 2rem;
        border-radius: 1rem;
        background: rgba(15, 23, 42, 0.6);
        border: 1px solid rgba(245, 158, 11, 0.2);
    }

    .stat-number {
        font-size: 3rem;
        font-weight: 700;
        color: var(--accent-color);
        margin-bottom: 0.5rem;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 hero-content">
                <h1 class="hero-title">
                    Descubre la Magia de<br>
                    NightFox
                </h1>
                <p class="hero-subtitle">
                    Un espacio único donde los sabores extraordinarios se encuentran con momentos inolvidables.
                    Explora nuestra selecta carta de bebidas y déjate sorprender por nuestra cocina de autor.
                </p>
                <div class="d-flex gap-3">
                    <a href="{{ route('menu') }}" class="btn btn-custom">
                        <i class="fas fa-glasses me-2"></i>Explorar Carta
                    </a>
                    <a href="{{ route('reservas') }}" class="btn btn-outline-light rounded-pill px-4">
                        <i class="fas fa-calendar-check me-2"></i>Reservar Mesa
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card h-100">
                    <div class="feature-icon mx-auto">
                        <i class="fas fa-cocktail"></i>
                    </div>
                    <h3 class="h4 mb-3 text-warning">Mixología de Autor</h3>
                    <p class="text-white-50">
                        Descubre nuestros cócteles exclusivos, creados por mixólogos expertos utilizando técnicas innovadoras y los mejores destilados.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="feature-card h-100">
                    <div class="feature-icon mx-auto">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <h3 class="h4 mb-3 text-warning">Gastronomía Selecta</h3>
                    <p class="text-white-50">
                        Sabores únicos en cada plato, preparados con ingredientes premium y técnicas culinarias de vanguardia.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="feature-card h-100">
                    <div class="feature-icon mx-auto">
                        <i class="fas fa-star"></i>
                    </div>
                    <h3 class="h4 mb-3 text-warning">Experiencia VIP</h3>
                    <p class="text-white-50">
                        Disfruta de un servicio personalizado en un ambiente sofisticado con música en vivo y eventos exclusivos.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-3 col-6">
                <div class="stat-card">
                    <div class="stat-number">5+</div>
                    <div class="text-white-50">Años de Experiencia</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-card">
                    <div class="stat-number">50+</div>
                    <div class="text-white-50">Cócteles Únicos</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-card">
                    <div class="stat-number">1000+</div>
                    <div class="text-white-50">Clientes Satisfechos</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-card">
                    <div class="stat-number">30+</div>
                    <div class="text-white-50">Eventos Mensuales</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-5">
    <div class="container">
        <div class="card p-5 text-center" style="background: rgba(15, 23, 42, 0.9); border: 2px solid var(--accent-color);">
            <h2 class="display-4 mb-4 text-warning">¿Listo para vivir la experiencia NightFox?</h2>
            <p class="lead mb-4 text-white-50">
                Únete a nuestra comunidad exclusiva y disfruta de beneficios especiales
            </p>
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('usuarios.productos.index') }}" class="btn btn-custom">
                    <i class="fas fa-shopping-cart me-2"></i>Ver Productos
                </a>
                @guest
                    <a href="{{ route('login') }}" class="btn btn-outline-warning rounded-pill px-4">
                        <i class="fas fa-user me-2"></i>Iniciar Sesión
                    </a>
                @endguest
            </div>
        </div>
    </div>
</section>
@endsection
