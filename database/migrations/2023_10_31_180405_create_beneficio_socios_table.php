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
        Schema::create('beneficio_socios', function (Blueprint $table) {
            $table->id();
            $table->integer('monto');
            $table->text('observacion')->nullable();
            $table->string('rut_id');
            $table->foreignId('benefit_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->date('fecha_asignacion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beneficio_socios');
    }
};
