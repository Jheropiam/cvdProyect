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
        Schema::create('cvd', function (Blueprint $table) {
            $table->bigIncrements('id_cvd');
            $table->string('code_cvd', 17);
            $table->unsignedBigInteger('id_user_fk');
            $table->foreign('id_user_fk')->references('id')->on('users');
            $table->unsignedBigInteger('id_doc_fk');
            $table->foreign('id_doc_fk')->references('id_doc')->on('documents');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cvd');
    }
};
