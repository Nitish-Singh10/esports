<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('e_football', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('class')->nullable();
            $table->string('rollno')->nullable();
            $table->string('phone_no');
            $table->string('email');
            $table->enum('pay_mode', ['upi', 'cash']);
            $table->string('transaction_id');
            $table->string('college');
            $table->string('amount')->default(75);
            $table->string('added_by');
            $table->boolean('verified')->default(0);
            $table->string('slot')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
