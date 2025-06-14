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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('rut');
            $table->string('nombre');
            $table->string('paterno');
            $table->string('materno');
            $table->string('telefono');
            $table->date('fecha_nacimiento');
            $table->date('fecha_ingreso_ubb');
            $table->date('fecha_ingreso_afunabb');
            $table->string('num_cuenta');
            $table->string('direccion');
            $table->enum('calidad',['CONTRATA','PLANTA']);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('sede_id')->constrained();
            $table->foreignId('reparticion_id')->constrained();
            $table->foreignId('cargo_id')->constrained();
            $table->foreignId('comuna_id')->constrained();
            $table->foreignId('cuenta_id')->constrained();
            $table->foreignId('banco_id')->constrained();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
