@extends('layouts.app2')

@section('title', 'Términos y Condiciones - NightFox')

@section('content')
<div class="row g-4">
    <!-- Encabezado -->
    <div class="col-12 text-center mb-5">
        <h1 class="display-4 fw-bold" style="color: var(--accent-color);">
            <i class="fas fa-file-contract me-2"></i>Términos y Condiciones
        </h1>
        <p class="lead text-white">Última actualización: Enero 2024</p>
        <div class="border-bottom border-warning my-4"></div>
    </div>

    <!-- Introducción -->
    <div class="col-12 mb-4">
        <div class="p-4 rounded-3" style="background: rgba(15, 23, 42, 0.5);">
            <h2 class="h4 mb-3" style="color: var(--accent-color);">1. Introducción</h2>
            <p class="text-white">
                Al acceder y utilizar los servicios de NightFox, usted acepta estos términos y condiciones en su totalidad.
                Si no está de acuerdo con estos términos y condiciones o alguna parte de estos, no debe utilizar nuestros servicios.
            </p>
        </div>
    </div>

    <!-- Elegibilidad -->
    <div class="col-12 mb-4">
        <div class="p-4 rounded-3" style="background: rgba(15, 23, 42, 0.5);">
            <h2 class="h4 mb-3" style="color: var(--accent-color);">2. Elegibilidad</h2>
            <p class="text-white">Para utilizar nuestros servicios, usted debe:</p>
            <ul class="text-white">
                <li>Ser mayor de 18 años</li>
                <li>Proporcionar información válida y verificable de su identidad</li>
                <li>Tener capacidad legal para realizar transacciones</li>
                <li>Aceptar ser responsable del uso adecuado de los productos adquiridos</li>
            </ul>
        </div>
    </div>

    <!-- Compras y Transacciones -->
    <div class="col-12 mb-4">
        <div class="p-4 rounded-3" style="background: rgba(15, 23, 42, 0.5);">
            <h2 class="h4 mb-3" style="color: var(--accent-color);">3. Compras y Transacciones</h2>
            <ul class="text-white">
                <li class="mb-2">Todos los precios están en dólares americanos e incluyen impuestos aplicables.</li>
                <li class="mb-2">Nos reservamos el derecho de rechazar cualquier pedido sin justificación.</li>
                <li class="mb-2">El pago debe realizarse en su totalidad antes del envío.</li>
                <li class="mb-2">Las descripciones de productos son lo más precisas posible.</li>
            </ul>
        </div>
    </div>

    <!-- Envíos y Entregas -->
    <div class="col-12 mb-4">
        <div class="p-4 rounded-3" style="background: rgba(15, 23, 42, 0.5);">
            <h2 class="h4 mb-3" style="color: var(--accent-color);">4. Envíos y Entregas</h2>
            <ul class="text-white">
                <li class="mb-2">Las entregas se realizan solo en las áreas de servicio designadas.</li>
                <li class="mb-2">Se requiere la presencia de una persona mayor de edad para recibir el pedido.</li>
                <li class="mb-2">Los tiempos de entrega son estimados y pueden variar.</li>
                <li class="mb-2">El cliente debe verificar el estado del producto al momento de la entrega.</li>
            </ul>
        </div>
    </div>

    <!-- Política de Devoluciones -->
    <div class="col-12 mb-4">
        <div class="p-4 rounded-3" style="background: rgba(15, 23, 42, 0.5);">
            <h2 class="h4 mb-3" style="color: var(--accent-color);">5. Política de Devoluciones</h2>
            <ul class="text-white">
                <li class="mb-2">No se aceptan devoluciones una vez abierto el producto.</li>
                <li class="mb-2">Los productos sellados pueden devolverse en un plazo de 24 horas.</li>
                <li class="mb-2">El producto debe estar en su empaque original y en perfectas condiciones.</li>
                <li class="mb-2">Los costos de devolución corren por cuenta del cliente.</li>
            </ul>
        </div>
    </div>

    <!-- Uso Responsable -->
    <div class="col-12 mb-4">
        <div class="p-4 rounded-3" style="background: rgba(15, 23, 42, 0.5);">
            <h2 class="h4 mb-3" style="color: var(--accent-color);">6. Uso Responsable</h2>
            <p class="text-white">
                NightFox promueve el consumo responsable de alcohol. Nos reservamos el derecho de:
            </p>
            <ul class="text-white">
                <li class="mb-2">Cancelar pedidos si sospechamos uso indebido.</li>
                <li class="mb-2">Reportar actividades sospechosas a las autoridades.</li>
                <li class="mb-2">Limitar la cantidad de productos por pedido.</li>
            </ul>
        </div>
    </div>

    <!-- Privacidad y Seguridad -->
    <div class="col-12 mb-4">
        <div class="p-4 rounded-3" style="background: rgba(15, 23, 42, 0.5);">
            <h2 class="h4 mb-3" style="color: var(--accent-color);">7. Privacidad y Seguridad</h2>
            <p class="text-white">
                Su privacidad es importante para nosotros. Toda la información recopilada está sujeta a nuestra política de privacidad.
                Utilizamos métodos de encriptación seguros para proteger su información personal y datos de pago.
            </p>
        </div>
    </div>

    <!-- Modificaciones -->
    <div class="col-12 mb-4">
        <div class="p-4 rounded-3" style="background: rgba(15, 23, 42, 0.5);">
            <h2 class="h4 mb-3" style="color: var(--accent-color);">8. Modificaciones</h2>
            <p class="text-white">
                NightFox se reserva el derecho de modificar estos términos y condiciones en cualquier momento.
                Los cambios entrarán en vigor inmediatamente después de su publicación en el sitio web.
                El uso continuo de nuestros servicios después de cualquier modificación constituye la aceptación de los nuevos términos.
            </p>
        </div>
    </div>

    <!-- Contacto -->
    <div class="col-12 mb-5">
        <div class="p-4 rounded-3" style="background: rgba(15, 23, 42, 0.5);">
            <h2 class="h4 mb-3" style="color: var(--accent-color);">9. Contacto</h2>
            <p class="text-white">
                Si tiene alguna pregunta sobre estos términos y condiciones, puede contactarnos a través de:
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
