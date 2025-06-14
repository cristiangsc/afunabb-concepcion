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
        Schema::create('directorios', function (Blueprint $table) {
            $table->id();
            $table->enum('cargo',['Presidente(a)','Secretario(a)','Tesorero(a)','Primer Director(a)','Segundo Director(a)']);
            $table->date('inicio');
            $table->date('termino');
            $table->enum('estado',['Vigente','No vigente'])->default('Vigente');
            $table->string('rut_id');
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('directorios');
    }
};
