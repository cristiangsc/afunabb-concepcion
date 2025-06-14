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
        Schema::create('ingresos_varios', function (Blueprint $table) {
            $table->id();
            $table->integer('monto');
            $table->date('fecha');
            $table->text('observacion')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('ingreso_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingresos_varios');
    }
};
