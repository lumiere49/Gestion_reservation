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
        Schema::create('ressources', function (Blueprint $table) {
        $table->bigIncrements('idRessource');

        $table->string('nom', 100);

        $table->string('type', 100);

        $table->enum('etat', [
                'Disponible',
                'Occupee',
                'Maintenance',
                'Hors_service'
                ]);

        $table->integer('capacite')->nullable();

        $table->text('description')->nullable();

        $table->unsignedBigInteger('idService');

        $table->foreign('idService')
              ->references('idService')
              ->on('services')
              ->onDelete('cascade');

        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ressources');
    }
};
