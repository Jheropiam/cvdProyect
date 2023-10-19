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
        Schema::create('documentosadjuntos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('documentos_id')->unsigned();
            $table->foreign('documentos_id')->references('id')->on('documentos')->onDelete('cascade');
            $table->string('documento', 250)->default('');
            $table->string('extension', 250)->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentosadjuntos');
    }
};
