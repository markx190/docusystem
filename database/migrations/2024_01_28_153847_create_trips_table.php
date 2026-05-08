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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->string('trip_id_no')->length(42);
            $table->string('bus_id_no')->length(190);
            $table->string('origin')->length(190);
            $table->string('destination')->length(190);
            $table->string('departure_datetime')->length(42);
            $table->string('eta')->length(42);
            $table->string('fare_amount')->length(42);
            $table->string('driver')->length(190);
            $table->string('conductor')->length(190);
            $table->string('s1', 42)->nullable();
            $table->string('s2', 42)->nullable();
            $table->string('s3', 42)->nullable();
            $table->string('s4', 42)->nullable();
            $table->string('s5', 42)->nullable();
            $table->string('s6', 42)->nullable();
            $table->string('s7', 42)->nullable();
            $table->string('s8', 42)->nullable();
            $table->string('s9', 42)->nullable();
            $table->string('s10', 42)->nullable();
            $table->string('s11', 42)->nullable();
            $table->string('s12', 42)->nullable();
            $table->string('s13', 42)->nullable();
            $table->string('s14', 42)->nullable();
            $table->string('s15', 42)->nullable();
            $table->string('s16', 42)->nullable();
            $table->string('s17', 42)->nullable();
            $table->string('s18', 42)->nullable();
            $table->string('s19', 42)->nullable();
            $table->string('s20', 42)->nullable();
            $table->string('company')->length(190);
            $table->string('status')->length(190);
            $table->string('created_by')->length(190);
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
        Schema::dropIfExists('trips');
    }
};
