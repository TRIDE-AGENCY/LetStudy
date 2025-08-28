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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tryout_id')->references('id')->on('tryouts')->cascadeOnDelete();
            $table->longText('question');
            $table->longText('option_1');
            $table->longText('option_2');
            $table->longText('option_3');
            $table->longText('option_4');
            $table->longText('option_5');
            $table->integer('answer');
            $table->longText('explanation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
