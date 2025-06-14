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
        Schema::create('inversions', function (Blueprint $table) {
            $table->id();
            $table->text('descripcion');
            $table->enum('documento',['Factura','Boleta','Notarial','Otro']);
            $table->enum('tipo',['Linea de negocio','Gremial']);
            $table->integer('num_documento');
            $table->integer('monto');
            $table->date('fecha');
            $table->text('observacion')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inversions');
    }
};
