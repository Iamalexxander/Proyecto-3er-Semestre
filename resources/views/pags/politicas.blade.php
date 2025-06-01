@extends('layouts.app2')

@section('title', 'Política de Privacidad - NightFox')

@section('content')
<div class="row g-4">
    <!-- Encabezado -->
    <div class="col-12 text-center mb-5">
        <h1 class="display-4 fw-bold" style="color: var(--accent-color);">
            <i class="fas fa-shield-alt me-2"></i>Política de Privacidad
        </h1>
        <p class="lead text-white">Última actualización: Enero 2024</p>
        <div class="border-bottom border-warning my-4"></div>
    </div>

    <!-- Introducción -->
    <div class="col-12 mb-4">
        <div class="p-4 rounded-3" style="background: rgba(15, 23, 42, 0.5);">
            <h2 class="h4 mb-3" style="color: var(--accent-color);">1. Introducción</h2>
            <p class="text-white">
                En NightFox, valoramos y respetamos su privacidad. Esta política describe cómo recopilamos,
                utilizamos y protegemos su información personal cuando utiliza nuestro sitio web y servicios.
                Al utilizar NightFox, usted acepta las prácticas descritas en esta política de privacidad.
            </p>
        </div>
    </div>

    <!-- Información que Recopilamos -->
    <div class="col-12 mb-4">
        <div class="p-4 rounded-3" style="background: rgba(15, 23, 42, 0.5);">
            <h2 class="h4 mb-3" style="color: var(--accent-color);">2. Información que Recopilamos</h2>
            <h3 class="h5 text-white mb-2">2.1 Información Personal</h3>
            <ul class="text-white mb-3">
                <li>Nombre completo</li>
                <li>Fecha de nacimiento</li>
                <li>Dirección de correo electrónico</li>
                <li>Número de teléfono</li>
                <li>Dirección de entrega</li>
                <li>Documento de identidad</li>
            </ul>

            <h3 class="h5 text-white mb-2">2.2 Información de Pago</h3>
            <ul class="text-white mb-3">
                <li>Detalles de tarjeta de crédito/débito</li>
                <li>Historial de transacciones</li>
                <li>Información de facturación</li>
            </ul>

            <h3 class="h5 text-white mb-2">2.3 Información Automática</h3>
            <ul class="text-white">
                <li>Dirección IP</li>
                <li>Tipo de navegador</li>
                <li>Dispositivo utilizado</li>
                <li>Patrones de uso del sitio web</li>
            </ul>
        </div>
    </div>

    <!-- Uso de la Información -->
    <div class="col-12 mb-4">
        <div class="p-4 rounded-3" style="background: rgba(15, 23, 42, 0.5);">
            <h2 class="h4 mb-3" style="color: var(--accent-color);">3. Uso de la Información</h2>
            <p class="text-white">Utilizamos su información para:</p>
            <ul class="text-white">
                <li>Procesar y entregar sus pedidos</li>
                <li>Verificar su edad e identidad</li>
                <li>Comunicarnos sobre su pedido</li>
                <li>Enviar actualizaciones y ofertas promocionales</li>
                <li>Mejorar nuestros servicios</li>
                <li>Prevenir fraudes</li>
                <li>Cumplir con requisitos legales</li>
            </ul>
        </div>
    </div>

    <!-- Protección de Datos -->
    <div class="col-12 mb-4">
        <div class="p-4 rounded-3" style="background: rgba(15, 23, 42, 0.5);">
            <h2 class="h4 mb-3" style="color: var(--accent-color);">4. Protección de Datos</h2>
            <p class="text-white">
                Implementamos medidas de seguridad rigurosas para proteger su información:
            </p>
            <ul class="text-white">
                <li>Encriptación SSL/TLS para todas las transacciones</li>
                <li>Sistemas de seguridad actualizados regularmente</li>
                <li>Acceso restringido a datos personales</li>
                <li>Monitoreo constante de seguridad</li>
                <li>Protocolos de respuesta a incidentes</li>
            </ul>
        </div>
    </div>

    <!-- Compartir Información -->
    <div class="col-12 mb-4">
        <div class="p-4 rounded-3" style="background: rgba(15, 23, 42, 0.5);">
            <h2 class="h4 mb-3" style="color: var(--accent-color);">5. Compartir Información</h2>
            <p class="text-white">Podemos compartir su información con:</p>
            <ul class="text-white">
                <li>Servicios de entrega para procesar pedidos</li>
                <li>Procesadores de pago para transacciones</li>
                <li>Autoridades legales cuando sea requerido</li>
                <li>Proveedores de servicios de verificación de edad</li>
            </ul>
            <p class="text-white mt-3">
                No vendemos ni compartimos su información personal con terceros para fines de marketing.
            </p>
        </div>
    </div>

    <!-- Cookies -->
    <div class="col-12 mb-4">
        <div class="p-4 rounded-3" style="background: rgba(15, 23, 42, 0.5);">
            <h2 class="h4 mb-3" style="color: var(--accent-color);">6. Cookies y Tecnologías de Seguimiento</h2>
            <p class="text-white">
                Utilizamos cookies y tecnologías similares para:
            </p>
            <ul class="text-white">
                <li>Mantener su sesión activa</li>
                <li>Recordar sus preferencias</li>
                <li>Analizar el uso del sitio</li>
                <li>Mejorar la experiencia del usuario</li>
            </ul>
        </div>
    </div>

    <!-- Derechos del Usuario -->
    <div class="col-12 mb-4">
        <div class="p-4 rounded-3" style="background: rgba(15, 23, 42, 0.5);">
            <h2 class="h4 mb-3" style="color: var(--accent-color);">7. Sus Derechos</h2>
            <p class="text-white">Usted tiene derecho a:</p>
            <ul class="text-white">
                <li>Acceder a su información personal</li>
                <li>Corregir datos inexactos</li>
                <li>Solicitar la eliminación de sus datos</li>
                <li>Oponerse al procesamiento de sus datos</li>
                <li>Retirar su consentimiento</li>
                <li>Solicitar la portabilidad de sus datos</li>
            </ul>
        </div>
    </div>

    <!-- Cambios en la Política -->
    <div class="col-12 mb-4">
        <div class="p-4 rounded-3" style="background: rgba(15, 23, 42, 0.5);">
            <h2 class="h4 mb-3" style="color: var(--accent-color);">8. Cambios en la Política</h2>
            <p class="text-white">
                Nos reservamos el derecho de actualizar esta política de privacidad en cualquier momento.
                Los cambios serán publicados en esta página y, cuando sea apropiado, se lo notificaremos por correo electrónico.
            </p>
        </div>
    </div>

    <!-- Contacto -->
    <div class="col-12 mb-5">
        <div class="p-4 rounded-3" style="background: rgba(15, 23, 42, 0.5);">
            <h2 class="h4 mb-3" style="color: var(--accent-color);">9. Contacto</h2>
            <p class="text-white">
                Si tiene preguntas sobre nuestra política de privacidad o el manejo de sus datos, contáctenos:
            </p>
            <ul class="text-white">
                <li><i class="fas fa-envelope me-2"></i>yohelitoalex79@gmail.com</li>
                <li><i class="fas fa-phone me-2"></i>0987279918</li>
            </ul>
        </div>
    </div>

    <!-- CTA -->
    <div class="col-12 text-center mb-4">
        <a href="{{ route('usuarios.productos.index') }}" class="btn btn-lg">
            <i class="fas fa-shopping-bag me-2"></i>Volver a la Tienda
        </a>
    </div>
</div>
@endsection
