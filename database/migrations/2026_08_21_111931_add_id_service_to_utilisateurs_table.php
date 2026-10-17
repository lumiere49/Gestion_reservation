<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ajouter le service auquel appartient l'utilisateur.
     */
    public function up(): void
    {
        Schema::table('utilisateurs', function (Blueprint $table) {
            $table->unsignedBigInteger('idService')
                ->nullable()
                ->after('role');

            $table->foreign('idService')
                ->references('idService')
                ->on('services')
                ->onDelete('set null');
        });
    }

    /**
     * Annuler la modification.
     */
    public function down(): void
    {
        Schema::table('utilisateurs', function (Blueprint $table) {
            $table->dropForeign(['idService']);
            $table->dropColumn('idService');
        });
    }
};