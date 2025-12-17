<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('game_registrations', function (Blueprint $table) {
            $table->id();

            // Game Details
            $table->string('game');
            $table->string('category')->nullable();
            $table->integer('amount');

            // User Details
            $table->string('full_name');
            $table->string('phone', 20);
            $table->string('email');
            $table->string('college_name');

            // Payment
            $table->string('transaction_id')->unique();

            // Admin
            $table->boolean('verified')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('game_registrations');
    }
};
