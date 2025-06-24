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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('country')->nullable();
            $table->string('nip')->nullable();
            $table->string('street')->nullable();
            $table->string('house_no')->nullable();
            $table->string('apartment_no')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('locality')->nullable();
            $table->string('directional')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('hashedPassword');
            $table->string('password');
            $table->enum('status' , ['online' , 'offline'])->nullable();
            $table->datetime('login_time')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
