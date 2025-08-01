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
        Schema::table('quiz_ans', function (Blueprint $table) {
            $table->boolean('is_correct')->default(false)->after('ans');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quiz_ans', function (Blueprint $table) {
            $table->dropColumn('is_correct');
        });
    }
};
