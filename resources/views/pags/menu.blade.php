@extends('layouts.app2')

@section('title', 'Menú - NightFox')

@section('content')
<div class="menu-container">
    <!-- Banner del Menú -->
    <div class="menu-banner text-center mb-5 p-5 rounded" style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('{{ asset('images/menu-banner.jpg') }}') center/cover; border: 2px solid var(--accent-color);">
        <h1 class="display-4 mb-3" style="font-family: 'Playfair Display', serif; color: var(--accent-color);">
            Nuestro Menú de Bebidas
        </h1>
        <p class="lead text-white">Descubre nuestra selección de cócteles y bebidas premium</p>
    </div>

    <!-- Categoría: Cócteles Signature -->
    <h2 class="text-center mb-4" style="color: var(--accent-color);">Cócteles Signature</h2>
    <div class="row g-4 mb-5">
        <!-- Cóctel 1 -->
        <div class="col-md-4">
            <div class="card h-100" style="background: rgba(30, 41, 59, 0.8); border: 1px solid var(--accent-color);">
                <img src="https://www.thecocktaildb.com/images/media/drink/vrwquq1478252802.jpg" class="card-img-top" alt="NightFox Especial" style="height: 250px; object-fit: cover;">
                <div class="card-body">
                    <h4 class="card-title text-center" style="color: var(--accent-color);">NightFox Especial</h4>
                    <p class="card-text text-white">Una mezcla única de ron añejo, licor de café, crema de coco y un toque de canela. Nuestra firma especial que representa la esencia de NightFox.</p>
                    <p class="text-white"><i class="fas fa-star me-2" style="color: var(--accent-color);"></i>Grado alcohólico: 18%</p>
                </div>
            </div>
        </div>

        <!-- Cóctel 2 -->
        <div class="col-md-4">
            <div class="card h-100" style="background: rgba(30, 41, 59, 0.8); border: 1px solid var(--accent-color);">
                <img src="https://www.thecocktaildb.com/images/media/drink/5noda61589575158.jpg" class="card-img-top" alt="Luna Azul" style="height: 250px; object-fit: cover;">
                <div class="card-body">
                    <h4 class="card-title text-center" style="color: var(--accent-color);">Luna Azul</h4>
                    <p class="card-text text-white">Ginebra premium, curaçao azul, jugo de limón y un toque de almíbar de vainilla. Decorado con frutos del bosque frescos.</p>
                    <p class="text-white"><i class="fas fa-star me-2" style="color: var(--accent-color);"></i>Grado alcohólico: 16%</p>
                </div>
            </div>
        </div>

        <!-- Cóctel 3 -->
        <div class="col-md-4">
            <div class="card h-100" style="background: rgba(30, 41, 59, 0.8); border: 1px solid var(--accent-color);">
                <img src="https://www.thecocktaildb.com/images/media/drink/2x8thr1504816928.jpg" class="card-img-top" alt="Fuego Nocturno" style="height: 250px; object-fit: cover;">
                <div class="card-body">
                    <h4 class="card-title text-center" style="color: var(--accent-color);">Fuego Nocturno</h4>
                    <p class="card-text text-white">Tequila reposado, jugo de lima, sirope de chile ancho y un toque de licor de naranja. Para los amantes del picante.</p>
                    <p class="text-white"><i class="fas fa-star me-2" style="color: var(--accent-color);"></i>Grado alcohólico: 20%</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Categoría: Clásicos Reinventados -->
    <h2 class="text-center mb-4" style="color: var(--accent-color);">Clásicos Reinventados</h2>
    <div class="row g-4 mb-5">
        <!-- Cóctel 4 -->
        <div class="col-md-4">
            <div class="card h-100" style="background: rgba(30, 41, 59, 0.8); border: 1px solid var(--accent-color);">
                <img src="https://www.thecocktaildb.com/images/media/drink/vrprxu1441553844.jpg" class="card-img-top" alt="Old Fashioned Premium" style="height: 250px; object-fit: cover;">
                <div class="card-body">
                    <h4 class="card-title text-center" style="color: var(--accent-color);">Old Fashioned Premium</h4>
                    <p class="card-text text-white">Bourbon selecto, bitter artesanal, azúcar moreno y una twist de naranja ahumada. Un clásico elevado a la excelencia.</p>
                    <p class="text-white"><i class="fas fa-star me-2" style="color: var(--accent-color);"></i>Grado alcohólico: 22%</p>
                </div>
            </div>
        </div>

        <!-- Cóctel 5 -->
        <div class="col-md-4">
            <div class="card h-100" style="background: rgba(30, 41, 59, 0.8); border: 1px solid var(--accent-color);">
                <img src="https://www.thecocktaildb.com/images/media/drink/6ck9yi1589574317.jpg" class="card-img-top" alt="Mojito de la Casa" style="height: 250px; object-fit: cover;">
                <div class="card-body">
                    <h4 class="card-title text-center" style="color: var(--accent-color);">Mojito de la Casa</h4>
                    <p class="card-text text-white">Ron blanco premium, hierba buena fresca, lima, azúcar moreno y un toque de agua de coco. Refrescante y sofisticado.</p>
                    <p class="text-white"><i class="fas fa-star me-2" style="color: var(--accent-color);"></i>Grado alcohólico: 15%</p>
                </div>
            </div>
        </div>

        <!-- Cóctel 6 -->
        <div class="col-md-4">
            <div class="card h-100" style="background: rgba(30, 41, 59, 0.8); border: 1px solid var(--accent-color);">
                <img src="https://www.thecocktaildb.com/images/media/drink/71t8581504353095.jpg" class="card-img-top" alt="Margarita Especial" style="height: 250px; object-fit: cover;">
                <div class="card-body">
                    <h4 class="card-title text-center" style="color: var(--accent-color);">Margarita Especial</h4>
                    <p class="card-text text-white">Tequila añejo, Cointreau, jugo de lima fresco y un borde de sal negra volcánica. Servido en copa escarchada.</p>
                    <p class="text-white"><i class="fas fa-star me-2" style="color: var(--accent-color);"></i>Grado alcohólico: 19%</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Categoría: Bebidas Premium -->
    <h2 class="text-center mb-4" style="color: var(--accent-color);">Bebidas Premium</h2>
    <div class="row g-4">
        <!-- Bebida 7 -->
        <div class="col-md-4">
            <div class="card h-100" style="background: rgba(30, 41, 59, 0.8); border: 1px solid var(--accent-color);">
                <img src="https://www.thecocktaildb.com/images/media/drink/dms3io1504366318.jpg" class="card-img-top" alt="Whisky Premium" style="height: 250px; object-fit: cover;">
                <div class="card-body">
                    <h4 class="card-title text-center" style="color: var(--accent-color);">Whisky Blue Label</h4>
                    <p class="card-text text-white">Whisky escocés premium, servido en cristal de alta calidad con hielo esférico. La experiencia perfecta para conocedores.</p>
                    <p class="text-white"><i class="fas fa-star me-2" style="color: var(--accent-color);"></i>Grado alcohólico: 40%</p>
                </div>
            </div>
        </div>

        <!-- Bebida 8 -->
        <div class="col-md-4">
            <div class="card h-100" style="background: rgba(30, 41, 59, 0.8); border: 1px solid var(--accent-color);">
                <img src="https://www.thecocktaildb.com/images/media/drink/2ahv791504352433.jpg" class="card-img-top" alt="Vodka Premium" style="height: 250px; object-fit: cover;">
                <div class="card-body">
                    <h4 class="card-title text-center" style="color: var(--accent-color);">Vodka Grey Goose</h4>
                    <p class="card-text text-white">Vodka ultra premium francés, servido a temperatura ideal con opción de acompañamiento de caviar de la casa.</p>
                    <p class="text-white"><i class="fas fa-star me-2" style="color: var(--accent-color);"></i>Grado alcohólico: 40%</p>
                </div>
            </div>
        </div>

        <!-- Bebida 9 -->
        <div class="col-md-4">
            <div class="card h-100" style="background: rgba(30, 41, 59, 0.8); border: 1px solid var(--accent-color);">
                <img src="https://www.thecocktaildb.com/images/media/drink/52weey1606772672.jpg" class="card-img-top" alt="Champagne Premium" style="height: 250px; object-fit: cover;">
                <div class="card-body">
                    <h4 class="card-title text-center" style="color: var(--accent-color);">Champagne Dom Pérignon</h4>
                    <p class="card-text text-white">Champagne vintage de la más alta calidad, servido en copa flauta de cristal fino. La elegancia en su máxima expresión.</p>
                    <p class="text-white"><i class="fas fa-star me-2" style="color: var(--accent-color);"></i>Grado alcohólico: 12.5%</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Nota Informativa -->
    <div class="card mt-5" style="background: rgba(30, 41, 59, 0.8); border: 1px solid var(--accent-color);">
        <div class="card-body text-center text-white">
            <h4 style="color: var(--accent-color);">Información Importante</h4>
            <p>Todas nuestras bebidas son preparadas con ingredientes de la más alta calidad. Los precios y disponibilidad pueden variar. Consulta con nuestro personal para más detalles.</p>
            <p><i class="fas fa-info-circle me-2" style="color: var(--accent-color);"></i>El consumo es exclusivo para mayores de 18 años.</p>
        </div>
    </div>
</div>
@endsection
