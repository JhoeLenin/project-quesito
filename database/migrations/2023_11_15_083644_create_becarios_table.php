<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PhpParser\Node\NullableType;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('becarios', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 10)->unique();
            $table->string('dni', 8)->unique();
            $table->string('nombre_apellido', 255);
            $table->string('direccion', 255);
            $table->string('telefono', 100);
            $table->string('fecha_nacimiento', 100);
            $table->string('email', 255)->unique();
            $table->string('estado', 5);
            $table->text('fotografia')->nullable();
            $table->string('fecha_ingreso', 50);
            $table->bigInteger('escuela_id')->unsigned();
            

            $table->timestamps();

            $table->foreign('escuela_id')->references('id')->on('escuelas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('becarios');
    }
};
