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
        Schema::table('units', function (Blueprint $table) {
            $table->integer('post_id')->nullable(); // String column
            $table->string('unit_size')->nullable(); // String column
            $table->integer('unit_features')->nullable(); // Integer column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('units', function (Blueprint $table) {
            $table->dropColumn(['post_id', 'unit_size', 'unit_features']);
        });
    }
};
