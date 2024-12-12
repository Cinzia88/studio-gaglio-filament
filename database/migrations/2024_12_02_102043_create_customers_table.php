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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('cognome');
            $table->string('telefono');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->tinyInteger('is_verified')->default(0);
            $table->string('password');
            $table->boolean('tesserato')->default(false);
            $table->string('n_tessera')->nullable();
            $table->string('device_token')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
