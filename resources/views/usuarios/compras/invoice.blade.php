<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Factura #{{ $compra->id }}</title>
    <style>
        @php
            $config = \App\Models\ConfiguracionFactura::obtenerConfiguracion();
            $colorPrimario = $config->color_primario ?? '#0066cc';
        @endphp
        
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.4;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: {{ $colorPrimario }};
            color: white;
            padding: 15px 0;
            text-align: center;
            margin-bottom: 20px;
        }
        .accent-stripe {
            background-color: {{ adjustBrightness($colorPrimario, 20) }};
            height: 4px;
            width: 100%;
        }
        .container {
            width: 100%;
            padding: 0 15px;
        }
        .info-section {
            border-top: 1px solid {{ $colorPrimario }};
            padding: 15px 0;
            margin-bottom: 20px;
        }
        .info-section::after {
            content: "";
            display: table;
            clear: both;
        }
        .company-info, .invoice-info {
            float: left;
            width: 50%;
        }
        .info-title {
            color: {{ $colorPrimario }};
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 12px;
        }
        .info-row {
            margin-bottom: 5px;
            font-size: 10px;
        }
        .info-label {
            display: inline-block;
            width: 80px;
            color: #666;
        }
        .invoice-number-box {
            background-color: {{ $colorPrimario }};
            color: white;
            padding: 5px 10px;
            text-align: center;
            font-weight: bold;
            margin-bottom: 10px;
            width: 80%;
        }
        .client-info {
            margin-top: 30px;
            border-top: 1px solid {{ $colorPrimario }};
            padding-top: 15px;
        }
        .client-box {
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            border-radius: 2px;
            padding: 10px;
            margin-top: 10px;
        }
        .client-row {
            margin-bottom: 5px;
            font-size: 10px;
        }
        .products-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .products-header {
            background-color: {{ $colorPrimario }};
            color: white;
            padding: 8px 0;
            text-align: center;
            font-weight: bold;
            font-size: 12px;
        }
        .products-table th {
            background-color: #f0f0f0;
            color: #333;
            padding: 8px;
            text-align: left;
            font-size: 10px;
        }
        .products-table td {
            padding: 8px;
            border-bottom: 1px solid #eee;
            font-size: 10px;
        }
        .products-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .totals-box {
            float: right;
            width: 250px;
            margin-top: 20px;
            background-color: #f5f5f5;
            padding: 10px;
            border-radius: 2px;
        }
        .totals-row {
            padding: 8px 0;
            border-bottom: 1px solid #eee;
            font-size: 10px;
        }
        .totals-row:last-child {
            border-bottom: none;
            font-weight: bold;
            color: {{ $colorPrimario }};
            font-size: 12px;
        }
        .totals-label {
            float: left;
        }
        .totals-value {
            float: right;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 9px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
        .watermark {
            position: absolute;
            top: 40%;
            left: 25%;
            transform: rotate(-30deg);
            font-size: 60px;
            color: rgba(200, 200, 200, 0.3);
            z-index: -1;
        }
        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }

        .signature-section {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
            align-items: center; /* Añadido para alinear verticalmente */
            flex-wrap: nowrap; /* Asegura que no se envuelvan */
        }

        .signature-box {
            width: 45%;
            text-align: center;
            flex-shrink: 0; /* Evita que se contraiga */
        }

        .signature-line {
            border-top: 1px solid #666;
            margin: 40px 0 10px;
        }

        .company-logo {
            max-height: 60px;
            max-width: 200px;
        }
    </style>
</head>
<body>
    @php
        $config = \App\Models\ConfiguracionFactura::obtenerConfiguracion();
        
        // Calculamos valores con IVA
        $subtotalSinIva = $compra->total / 1.15;
        $iva = $compra->total - $subtotalSinIva;
    @endphp
    
    <div class="watermark">PAGADO</div>
    
    <!-- Cabecera del Documento -->
    <div class="header">
        <h2 style="margin: 0;">FACTURA ELECTRÓNICA</h2>
        <p style="margin: 5px 0 0 0;">{{ $config->nombre_empresa }}</p>
    </div>
    <div class="accent-stripe"></div>
    
    <div class="container">
        <!-- Información General -->
        <div class="info-section">
            <div class="company-info">
                <div class="info-title">INFORMACIÓN DE LA EMPRESA</div>
                @if($config->mostrar_logo)
                @endif
                <div class="info-row">
                    <span class="info-label">Empresa:</span>
                    <strong>{{ $config->nombre_empresa }}</strong>
                </div>
                <div class="info-row">
                    <span class="info-label">NIT:</span>
                    {{ $config->nit }}
                </div>
                <div class="info-row">
                    <span class="info-label">Dirección:</span>
                    {{ $config->direccion }}
                </div>
                <div class="info-row">
                    <span class="info-label">Teléfono:</span>
                    {{ $config->telefono }}
                </div>
                <div class="info-row">
                    <span class="info-label">Email:</span>
                    {{ $config->email }}
                </div>
                @if($config->sitio_web)
                <div class="info-row">
                    <span class="info-label">Web:</span>
                    {{ $config->sitio_web }}
                </div>
                @endif
            </div>
            
            <div class="invoice-info">
                <div class="invoice-number-box">
                    FACTURA Nº {{ str_pad($compra->id, 6, '0', STR_PAD_LEFT) }}
                </div>
                <div class="info-row">
                    <span class="info-label">Fecha emisión:</span>
                    <strong>{{ $compra->created_at->format('d/m/Y') }}</strong>
                </div>
                <div class="info-row">
                    <span class="info-label">Hora:</span>
                    <strong>{{ $compra->created_at->format('H:i:s') }}</strong>
                </div>
                <div class="info-row">
                    <span class="info-label">Forma de pago:</span>
                    <strong>{{ $compra->metodo_pago ?? 'Efectivo' }}</strong>
                </div>
                <div class="info-row">
                    <span class="info-label">Estado:</span>
                    <strong>PAGADO</strong>
                </div>
            </div>
        </div>
        
        <!-- Información del Cliente -->
        <div class="client-info">
            <div class="info-title">DATOS DEL CLIENTE</div>
            <div class="client-box">
                <div class="row">
                    <div class="client-row">
                        <strong>Nombre:</strong> 
                        {{ $compra->usuario->nombre_usuario }}
                        
                        @if($compra->usuario->telefono)
                        <span style="margin-left: 100px;"><strong>Teléfono:</strong> 
                        {{ $compra->usuario->telefono }}</span>
                        @endif
                    </div>
                    
                    @if($compra->usuario->email)
                    <div class="client-row">
                        <strong>Correo:</strong> 
                        {{ $compra->usuario->email }}
                        
                        @if($compra->usuario->direccion)
                        <span style="margin-left: 100px;"><strong>Dirección:</strong> 
                        {{ $compra->usuario->direccion }}</span>
                        @endif
                    </div>
                    @endif
                    
                    @if($compra->usuario->documento)
                    <div class="client-row">
                        <strong>Documento:</strong> 
                        {{ $compra->usuario->documento }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Tabla de Productos -->
        <div style="margin-top: 30px;">
            <div class="products-header">DETALLE DE PRODUCTOS</div>
            <table class="products-table">
                <thead>
                    <tr>
                        <th width="10%">ID</th>
                        <th width="40%">Descripción del Producto</th>
                        <th width="15%">Precio Unit.</th>
                        <th width="15%">Cantidad</th>
                        <th width="20%">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($compra->productos as $producto)
                    <tr>
                        <td>{{ $producto->id }}</td>
                        <td>
                            <strong>{{ $producto->nombre }}</strong>
                            @if($producto->descripcion)
                            <br>
                            <small>{{ \Illuminate\Support\Str::limit($producto->descripcion, 60) }}</small>
                            @endif
                        </td>
                        <td>{{ $config->moneda }}{{ number_format($producto->pivot->subtotal / $producto->pivot->cantidad, 2) }}</td>
                        <td>{{ $producto->pivot->cantidad }}</td>
                        <td>{{ $config->moneda }}{{ number_format($producto->pivot->subtotal, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Sección de Totales -->
        <div class="clearfix">
            <div class="totals-box">
                <div class="totals-row">
                    <span class="totals-label">Subtotal (Sin IVA):</span>
                    <span class="totals-value">{{ $config->moneda }}{{ number_format($subtotalSinIva, 2) }}</span>
                    <div style="clear: both;"></div>
                </div>
                <div class="totals-row">
                    <span class="totals-label">IVA (15%):</span>
                    <span class="totals-value">{{ $config->moneda }}{{ number_format($iva, 2) }}</span>
                    <div style="clear: both;"></div>
                </div>
                <div class="totals-row">
                    <span class="totals-label">TOTAL A PAGAR:</span>
                    <span class="totals-value">{{ $config->moneda }}{{ number_format($compra->total, 2) }}</span>
                    <div style="clear: both;"></div>
                </div>
            </div>
        </div>       
        
        <!-- Términos y condiciones si existen -->
        @if($config->texto_condiciones)
        <div style="margin-top: 20px; font-size: 9px; border-top: 1px dashed #ccc; padding-top: 10px;">
            <strong>Términos y condiciones:</strong>
            <p>{{ $config->texto_condiciones }}</p>
        </div>
        @endif
        
        <!-- Pie de Página -->
        <div class="footer">
            @if($config->texto_agradecimiento)
            <p><strong>{{ $config->texto_agradecimiento }}</strong></p>
            @endif
            
            <p>{{ $config->texto_footer }}</p>
            <p>Documento generado electrónicamente por {{ $config->nombre_empresa }} © {{ date('Y') }}</p>
            <p>Esta factura fue generada el {{ $compra->created_at->format('d/m/Y') }} a las {{ $compra->created_at->format('H:i:s') }}</p>
            <p style="margin-top: 10px; font-size: 8px; color: #999;">ID de transacción: {{ md5($compra->id . $compra->created_at) }}</p>
        </div>
    </div>
</body>
</html>