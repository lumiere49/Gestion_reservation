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
        Schema::create('prestations', function (Blueprint $table) {
            $table->bigIncrements('idPrestation');

        $table->string('nom', 100);

        $table->text('description')->nullable();

        $table->decimal('prix', 10, 2);

        $table->integer('duree');

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
        Schema::dropIfExists('prestations');
    }
};
