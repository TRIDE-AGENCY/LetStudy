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
        Schema::create('donates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('achievement1_id')->nullable()->constrained('achievements')->nullOnDelete();
            $table->foreignId('achievement2_id')->nullable()->constrained('achievements')->nullOnDelete();
            $table->foreignId('achievement3_id')->nullable()->constrained('achievements')->nullOnDelete();
            $table->string('bank_name');
            $table->string('bank_number');
            $table->string('bank_account');
            $table->string('qrcode_image')->nullable();
            $table->string('qrcode_name');
            $table->string('qrcode_nmid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donates');
    }
};
