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
        Schema::create('reservations', function (Blueprint $table) {
            $table->bigIncrements('idReservation');

            $table->date('date_reservation');

            $table->time('heure_debut');

            $table->time('heure_fin');

            $table->enum('statut', [
                        'En_attente',
                        'Confirmee',
                        'Annulee',
                        'Terminee'
                    ]);

            $table->enum('canal_reservation', [
                       'Telephone',
                       'Physique',
                       'Email',
                       'Site_web',
                       'Application_mobile'
         ]);

            $table->unsignedBigInteger('idClient');

            $table->foreign('idClient')

                  ->references('idClient')
                  ->on('clients')
                  ->onDelete('cascade');

            $table->unsignedBigInteger('idUtilisateur');
        
            $table->foreign('idUtilisateur')
                  ->references('idUtilisateur')
                  ->on('utilisateurs')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
