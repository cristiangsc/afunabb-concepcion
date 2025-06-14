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
        Schema::create('cafeteria_ingresos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('caja')->nullable()->default(0);
            $table->bigInteger('transbank')->nullable()->default(0);
            $table->bigInteger('junaeb')->nullable()->default(0);
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
        Schema::dropIfExists('cafeteria_ingresos');
    }
};
