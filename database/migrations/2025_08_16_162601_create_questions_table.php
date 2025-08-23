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
            $table->string('question_image')->nullable();
            $table->text('option_1');
            $table->string('option_1_image')->nullable();
            $table->text('option_2');
            $table->string('option_2_image')->nullable();
            $table->text('option_3');
            $table->string('option_3_image')->nullable();
            $table->text('option_4');
            $table->string('option_4_image')->nullable();
            $table->text('option_5');
            $table->string('option_5_image')->nullable();
            $table->integer('answer');
            $table->longText('explanation')->nullable();
            $table->string('explanation_image')->nullable();   
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
