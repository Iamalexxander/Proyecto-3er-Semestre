<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sistema de Inventario')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

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
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 1rem;
            max-width: 1100px;
        }

        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--accent-color) !important;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }

        .navbar-brand:hover {
            color: var(--accent-color2) !important;
            transform: scale(1.05);
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

        .container.py-4 {
            background: rgba(30, 41, 59, 0.8);
            backdrop-filter: blur(10px);
            border-radius: 1rem;
            padding: 2rem;
            margin-top: 2rem; /* Añade espacio arriba para separarlo de la navbar */
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

        .alert {
            background: var(--dark-overlay);
            border-left: 4px solid var(--accent-color);
            color: var(--text-color);
            border-radius: 0.5rem;
            margin-bottom: 1rem;
        }

        .alert-success {
            border-left-color: #10b981;
        }

        .alert-danger {
            border-left-color: #ef4444;
        }

        .loader {
            background: var(--dark-overlay);
        }

        .loader-spinner {
            border-color: var(--accent-color);
            border-top-color: var(--text-color);
        }

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
        }

        @media (max-width: 991px) {
            .navbar-brand {
                font-size: 1.5rem;
            }

            .container.py-4 {
                padding: 1rem;
            }
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">
    <!-- Loader -->
    <div class="loader">
        <div class="loader-spinner"></div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-wine-bottle me-2"></i>NightFox Admin
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <i class="fas fa-bars text-white"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto">
                    @auth
                        @role('admin')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.productos.index') }}">
                                    <i class="fas fa-box me-1"></i>Productos
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.clientes.index') }}">
                                    <i class="fas fa-users me-1"></i>Usarios
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.cardex.index') }}">
                                    <i class="fas fa-warehouse me-1"></i>Cardex
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.categorias.index') }}">
                                    <i class="fas fa-tags me-1"></i>Categorias
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.reportes.index') }}">
                                    <i class="fas fa-chart-bar me-1"></i>Reporte
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.configuracion_factura.edit') }}">
                                    <i class="fas fa-file-invoice me-1"></i>Config. Facturas
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('usuarios.productos.index') }}">
                                    <i class="fas fa-store me-1"></i>Productos
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('usuarios.compras') }}">
                                    <i class="fas fa-shopping-cart me-1"></i>Mis Compras
                                </a>
                            </li>
                        @endrole
                    @endauth
                </ul>

                <div class="auth-links">
                    @guest
                        <a href="{{ route('login') }}" class="nav-link">
                            <i class="fas fa-sign-in-alt me-1"></i>Iniciar Sesión
                        </a>
                        <a href="{{ route('register') }}" class="nav-link">
                            <i class="fas fa-user-plus me-1"></i>Registrarse
                        </a>
                    @else
                        <div class="dropdown">
                            <button class="nav-link dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown">
                                <i class="fas fa-user me-1"></i>{{ Auth::user()->nombre_usuario }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="fas fa-sign-out-alt me-1"></i>Cerrar Sesión
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow-1">
        <div class="container py-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-1"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-1"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

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
                    <h5>Información del Sistema de Administración</h5>
                    <p class="text-white">
                        - Aquí puedes añadir productos, usuarios, kardex, categorías y reportes.
                    </p>                    
                </div>                
                <div class="col-md-4">
                    <h5>Sistema de Administración</h5>
                    <p class="mb-0">&copy; {{ date('Y') }} NightFox. Todos los derechos reservados.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('form');
            const loader = document.querySelector('.loader');

            forms.forEach(form => {
                form.addEventListener('submit', function() {
                    loader.style.display = 'flex';
                });
            });
        });

        window.setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>

    @yield('scripts')
</body>
</html>
