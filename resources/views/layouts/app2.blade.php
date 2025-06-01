<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bar & Restaurante')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --primary-color: #0f172a;
            --secondary-color: #1e293b;
            --accent-color: #f59e0b;
            --accent-color2: #b45309;
            --text-color: #ffffff;
            --dark-overlay: rgba(15, 23, 42, 0.98);
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-color);
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: relative;
            overflow-x: hidden;
        }

        /* Efecto de luz ambiental */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background:
                radial-gradient(circle at 20% 20%, rgba(245, 158, 11, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(180, 83, 9, 0.15) 0%, transparent 50%),
                repeating-linear-gradient(45deg, rgba(255, 255, 255, 0.02) 0px, rgba(255, 255, 255, 0.02) 1px, transparent 1px, transparent 10px);
            pointer-events: none;
            z-index: 0;
        }

        .navbar {
            background: rgba(15, 23, 42, 0.95) !important;
            backdrop-filter: blur(10px);
            border-bottom: 2px solid var(--accent-color);
            padding: 1rem 0;
            position: relative;
            z-index: 1030;
        }

        .navbar .container {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: center;
            gap: 1rem;
            padding: 0 1rem;
            max-width: 1400px;
            width: 100%;
        }

        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--accent-color) !important;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
            color: var(--accent-color2) !important;
        }

        .left-nav,
        .right-nav {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .left-nav {
            justify-content: flex-end;
        }

        .right-nav {
            justify-content: flex-start;
        }


        .nav-link {
            color: var(--text-color) !important;
            font-weight: 500;
            padding: 0.5rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            white-space: nowrap;
        }

        .nav-link i {
            margin-right: 0.5rem;
        }

        .nav-link:hover {
            color: var(--accent-color) !important;
            transform: translateY(-2px);
        }

        .profile-dropdown .nav-link {
            padding: 0.5rem;
            font-size: 1.2rem;
            margin-left: 0.5rem;
        }

        .profile-dropdown .dropdown-menu {
            min-width: 200px;
            padding: 0.5rem 0;
        }

        .container.mt-4 {
            background: rgba(30, 41, 59, 0.8);
            backdrop-filter: blur(10px);
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(245, 158, 11, 0.2);
            margin-bottom: 2rem;
            position: relative;
            z-index: 1;
            flex: 1;
        }

        .btn {
            background: linear-gradient(45deg, var(--accent-color), var(--accent-color2));
            color: white;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            border: none;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
        }

        /* Mejora del dropdown */
        .dropdown-menu {
            background: var(--dark-overlay);
            border: 2px solid var(--accent-color);
            border-radius: 0.5rem;
            position: absolute;
            z-index: 1050;
            margin-top: 0.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        .dropdown-item {
            color: var(--text-color);
            padding: 0.75rem 1.5rem;
            transition: all 0.3s ease;
            position: relative;
            z-index: 1050;
        }

        .dropdown-item:hover {
            background: linear-gradient(45deg, var(--accent-color), var(--accent-color2));
            color: white;
            transform: translateX(5px);
        }

        footer {
            background: var(--dark-overlay);
            border-top: 2px solid var(--accent-color);
            padding: 2rem 0;
            margin-top: auto;
            position: relative;
            z-index: 1;
        }

        footer h5 {
            color: var(--accent-color);
            font-family: 'Playfair Display', serif;
            font-weight: 600;
            margin-bottom: 1.5rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        .social-links {
            display: flex;
            gap: 1rem;
        }

        .social-links a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(45deg, var(--accent-color), var(--accent-color2));
            transition: all 0.3s ease;
            text-decoration: none;
            position: relative;
            overflow: hidden;
        }

        .social-links a:hover {
            transform: translateY(-3px) rotate(360deg);
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
        }

        .social-links a i {
            font-size: 1.2rem;
            color: white;
        }

        .list-unstyled a {
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
            margin: 0.5rem 0;
            color: var(--text-color) !important;
            position: relative;
            padding-left: 1.5rem;
        }

        .list-unstyled a:before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            width: 0.5rem;
            height: 0.5rem;
            background: var(--accent-color);
            transform: translateY(-50%);
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .list-unstyled a:hover {
            color: var(--accent-color) !important;
            transform: translateX(5px);
        }

        .list-unstyled a:hover:before {
            transform: translateY(-50%) scale(1.5);
        }

        /* Animación de brillo para elementos destacados */
        @keyframes shine {
            0% {
                background-position: 200% center;
            }

            100% {
                background-position: -200% center;
            }
        }

        /* Media Queries mejorados */
        @media (max-width: 768px) {
            .navbar-collapse {
                background: var(--dark-overlay);
                padding: 1rem;
                border-radius: 0.5rem;
                margin-top: 1rem;
                border: 1px solid var(--accent-color);
            }

            .nav-link {
                padding: 0.5rem;
                width: 100%;
                text-align: center;
            }

            .dropdown-menu {
                margin: 0;
                background: rgba(15, 23, 42, 0.98);
            }

            footer {
                text-align: center;
            }

            .social-links {
                justify-content: center;
            }
        }

        @media (max-width: 991px) {
            .navbar-brand {
                position: static;
                transform: none;
                margin: 0;
            }

            .navbar-brand:hover {
                transform: scale(1.05);
            }

            .left-nav,
            .right-nav {
                margin-top: 1rem;
                flex-direction: column;
                width: 100%;
                gap: 0.5rem;
                align-items: stretch;
            }

            .nav-link {
                justify-content: center;
            }

            .navbar .container {
                flex-wrap: wrap;
            }

            .profile-dropdown {
                margin-top: 0.5rem;
            }
        }
    </style>
</head>

<body class="d-flex flex-column">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <!-- Enlaces izquierdos -->
            <ul class="navbar-nav left-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('usuarios.productos.index') }}">
                        <i class="fas fa-shopping-bag me-1"></i>Productos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('menu') }}">
                        <i class="fas fa-glass-martini-alt me-1"></i>Carta de Bebidas
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('eventos') }}">
                        <i class="fas fa-calendar-alt me-1"></i>Eventos
                    </a>
                </li>
            </ul>

            <!-- Logo central -->
            <a class="navbar-brand mx-auto" href="/">
                <i class="fas fa-store me-2"></i>NightFox
            </a>

            <!-- Enlaces derechos -->
            <ul class="navbar-nav right-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('reservas') }}">
                        <i class="fas fa-bookmark me-1"></i>Reservas
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('ubicacion') }}">
                        <i class="fas fa-map-marker-alt me-2"></i>Ubicación
                    </a>
                </li>
                @guest
                    <li class="nav-item profile-dropdown">
                        <a class="nav-link" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle fa-lg"></i>
                            <span style="font-family: 'Times New Roman', Times, serif;">Iniciar Sesión</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('login') }}">
                                    <i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('register') }}">
                                    <i class="fas fa-user-plus me-2"></i>Registrarse
                                </a>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i>{{ Auth::user()->nombre }}
                            <span style="font-family: 'Playfair Display', Times, serif; font-size: 18px;">Perfil</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('usuarios.perfil') }}">
                                    <i class="fas fa-user me-2"></i>Mi Perfil
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('usuarios.compras.index') }}">                                    <i class="fas fa-receipt me-2"></i>Mis Compras
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('carrito.mostrar') }}">
                                    <i class="fas fa-basket-shopping"></i> Mi Carrito
                                    @if (session()->has('cart') && count(session('cart')) > 0)
                                        <span class="badge"
                                            style="background: linear-gradient(45deg, var(--accent-color), var(--accent-color2));">
                                            {{ count(session('cart')) }}
                                        </span>
                                    @endif
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item">
                                        <i class="fas fa-sign-out-alt me-2"></i>Cerrar Sesión
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>

            <!-- Botón hamburguesa para móvil -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="fas fa-bars text-white"></i>
            </button>
        </div>
    </nav>

    <div class="container mt-4 flex-grow-1">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row gy-4">
                <div class="col-md-4">
                    <h5>Contacto</h5>
                    <p><i class="fas fa-envelope me-2"></i>yohelitoalex79@gmail.com</p>
                    <p><i class="fas fa-phone me-2"></i>0987279918</p>
                </div>
                <div class="col-md-4">
                    <h5>Enlaces Rápidos</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('sobre') }}" class="text-white"><i
                                    class="fas fa-info-circle me-2"></i>Sobre Nosotros</a></li>
                        <li><a href="{{ route('terminos') }}" class="text-white"><i
                                    class="fas fa-file-contract me-2"></i>Términos y Condiciones</a></li>
                        <li><a href="{{ route('politicas') }}" class="text-white"><i
                                    class="fas fa-shield-alt me-2"></i>Política de Privacidad</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Síguenos</h5>
                    <div class="social-links">
                        <a href="https://www.facebook.com/alexander.mena.142?locale=es_LA" class="text-white"><i
                                class="fab fa-facebook-f"></i></a>
                        <a href="https://x.com/FOXYGAM92754440" class="text-white"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.instagram.com/iam_alexxander_/" class="text-white"><i
                                class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
