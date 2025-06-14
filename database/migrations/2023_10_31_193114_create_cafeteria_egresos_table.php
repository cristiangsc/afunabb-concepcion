<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cafeteria_egresos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('facturas')->nullable()->default(0);
            $table->bigInteger('impuestos')->nullable()->default(0);
            $table->bigInteger('comision_junaeb')->nullable()->default(0);
            $table->bigInteger('remuneraciones')->nullable()->default(0);
            $table->bigInteger('imposiciones')->nullable()->default(0);
            $table->bigInteger('honorarios')->nullable()->default(0);
            $table->text('observaciones')->nullable();
            $table->enum('mes',['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre']);
            $table->integer('anio');
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cafeteria_egresos');
    }
};
