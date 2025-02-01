<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id('location_id'); // Auto-increment primary key
            $table->integer('location_number');
            $table->boolean('enable')->default(true);
            $table->unsignedBigInteger('created_by_id');
            $table->unsignedBigInteger('last_updated_by_id');
            $table->timestamp('created_datetime')->useCurrent();
            $table->timestamp('updated_datetime')->useCurrent()->useCurrentOnUpdate();

            // Add foreign key constraints if necessary
            // $table->foreign('created_by_id')->references('id')->on('users');
            // $table->foreign('last_updated_by_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locations');
    }
}
