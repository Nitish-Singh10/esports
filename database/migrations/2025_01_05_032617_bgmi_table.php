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
        Schema::create('bgmi_team', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('class');
            $table->string('rollno');
            $table->string('phone_no');
            $table->string('email');
            $table->enum('pay_mode', ['upi', 'cash']);
            $table->string('transaction_id');
            $table->string('amount')->default(200);
            $table->timestamps();
        });

        Schema::create('bgmi_duo', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('class');
            $table->string('rollno');
            $table->string('phone_no');
            $table->string('email');
            $table->enum('pay_mode', ['upi', 'cash']);
            $table->string('transaction_id');
            $table->string('amount')->default(100);
            $table->timestamps();
        });

        Schema::create('bgmi_solo', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('class');
            $table->string('rollno');
            $table->string('phone_no');
            $table->string('email');
            $table->enum('pay_mode', ['upi', 'cash']);
            $table->string('transaction_id');
            $table->string('amount')->default(50);
            $table->timestamps();
        });

        DB::statement("ALTER TABLE bgmi_team AUTO_INCREMENT = 2501;");
        DB::statement("ALTER TABLE bgmi_duo AUTO_INCREMENT = 2501;");
        DB::statement("ALTER TABLE bgmi_solo AUTO_INCREMENT = 2501;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};