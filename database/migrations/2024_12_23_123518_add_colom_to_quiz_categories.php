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
        Schema::table('quiz_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('quiz_id')->after('id');
            $table->unsignedBigInteger('category_id')->after('quiz_id');

            $table->foreign('quiz_id')->references('id')->on('quizzes')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->unique(['quiz_id', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quiz_categories', function (Blueprint $table) {
            $table->dropForeign(['quiz_id']);
            $table->dropForeign(['category_id']);
            $table->dropColumn(['quiz_id', 'category_id']);
            $table->dropUnique(['quiz_id', 'category_id']);
        });
    }
};
