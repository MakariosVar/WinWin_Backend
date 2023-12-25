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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('amount')->nullable(); // Decimal field with precision and scale
            $table->boolean('sponsored')->default(false); // Boolean field for sponsorship status
            $table->boolean('repeated')->default(false); // Integer field for repeated count
            $table->date('expires_at')->nullable();
            $table->string('image')->nullable();
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
