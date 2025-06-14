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
        Schema::create('aportes', function (Blueprint $table) {
            $table->id();
            $table->integer('socios');
            $table->integer('monto');
            $table->enum('mes',['Enero','Febrero','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre']);
            $table->integer('anio');
            $table->date('fecha');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('sede_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aportes');
    }
};
