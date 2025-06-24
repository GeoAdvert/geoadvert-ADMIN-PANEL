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
        Schema::create('quiz_ans', function (Blueprint $table) {
            $table->id();
            $table->integer('quiz_id');
            $table->string('advertisement_id')->nullable();
            $table->string('ans');
            $table->boolean('is_first')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_ans');
    }

};
