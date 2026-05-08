<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buses', function (Blueprint $table) {
            $table->id();
            $table->string('bus_id_no')->length(42);
            $table->string('bus_name')->length(190);
            $table->string('bus_number')->length(190);
            $table->string('engine')->length(190);
            $table->string('seats')->length(42);
            $table->string('aircon')->length(42);
            $table->string('movie')->length(42);
            $table->string('wifi')->length(42);
            $table->string('toilet')->length(42);
            $table->string('status')->length(100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buses');
    }
};
