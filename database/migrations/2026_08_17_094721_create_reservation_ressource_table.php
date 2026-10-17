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
        Schema::create('reservation_ressource', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->unsignedBigInteger('idReservation');

            $table->unsignedBigInteger('idRessource');

            $table->timestamps();

            $table->foreign('idReservation')
                  ->references('idReservation')
                  ->on('reservations')
                  ->onDelete('cascade');

            $table->foreign('idRessource')
                  ->references('idRessource')
                  ->on('ressources')
                  ->onDelete('cascade');

            $table->unique([
                'idReservation',
                'idRessource'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation_ressource');
    }
};