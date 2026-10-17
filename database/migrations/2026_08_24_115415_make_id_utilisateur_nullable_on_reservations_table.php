<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Rendre idUtilisateur facultatif
     * pour permettre les réservations publiques.
     */
    public function up(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->unsignedBigInteger('idUtilisateur')
                ->nullable()
                ->change();
        });
    }

    /**
     * Revenir à l'état précédent.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->unsignedBigInteger('idUtilisateur')
                ->nullable(false)
                ->change();
        });
    }
};