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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_product_id')->nullable()->constrained('sub_products')->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('image');
            $table->longText('content');
            $table->enum('status', ['published', 'archived']);
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    /**h
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
