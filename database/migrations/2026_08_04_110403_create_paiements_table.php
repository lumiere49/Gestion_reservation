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
        Schema::create('paiements', function (Blueprint $table) {
            $table->bigIncrements('idPaiement');
            $table->decimal('montant', 10, 2);
            $table->date('date_paiement');
            $table->enum('mode_paiement', [
                        'Especes',
                        'Orange_Money',
                        'MTN MoMo',
                       ]);
            $table->enum('statut', [
                        'En_attente',
                        'payer',
                        'echouer',
                    ]);
            $table->string('reference_paiement', 100)->nullable();

            $table->unsignedBigInteger('idReservation');

            $table->foreign('idReservation')
                  ->references('idReservation')
                  ->on('reservations')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
