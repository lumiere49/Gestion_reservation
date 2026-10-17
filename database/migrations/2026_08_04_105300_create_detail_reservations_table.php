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
        Schema::create('detail_reservations', function (Blueprint $table) {
            $table->bigIncrements('idDetail');

        $table->integer('quantite')->default(1);

        $table->decimal('prix', 10, 2);

        $table->unsignedBigInteger('idReservation');

        $table->foreign('idReservation')
              ->references('idReservation')
              ->on('reservations')
              ->onDelete('cascade');

        $table->unsignedBigInteger('idPrestation');

        $table->foreign('idPrestation')
              ->references('idPrestation')
              ->on('prestations')
              ->onDelete('cascade');

        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_reservations');
    }
};
