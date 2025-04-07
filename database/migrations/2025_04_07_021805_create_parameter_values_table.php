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
        Schema::create('parameter_values', function (Blueprint $table) {
            $table->id();
            $table->string('value');
            $table->unsignedBigInteger('parameter_id');
            $table->foreign('parameter_id')->references('id')->on('parameters')->onDelete('cascade');
            $table->unique(['parameter_id', 'value']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parameter_values');
    }
};
