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
        Schema::create('ebooks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_product_id')->references('id')->on('sub_products')->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('id_ebook')->unique();
            $table->string('id_form');
            $table->date('launch_date');
            $table->integer('total_pages');
            $table->string('image');
            $table->longText('description');
            $table->longText('benefit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ebooks');
    }
};
