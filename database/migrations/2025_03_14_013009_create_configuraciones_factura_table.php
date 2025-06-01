<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfiguracionesFacturaTable extends Migration
{
    public function up()
    {
        Schema::create('configuraciones_factura', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_empresa');
            $table->string('nit');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('email');
            $table->string('sitio_web')->nullable();
            $table->string('logo')->nullable();
            $table->text('texto_footer')->nullable();
            $table->text('texto_condiciones')->nullable();
            $table->text('texto_agradecimiento')->nullable();
            $table->string('moneda')->default('$');
            $table->string('texto_firma')->nullable();
            $table->string('color_primario')->default('#0066cc');
            $table->boolean('mostrar_logo')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('configuraciones_factura');
    }
}