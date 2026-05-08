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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('trans_id_no')->length(42);
            $table->string('trip_id_no')->length(42);
            $table->string('qr_code')->length(42);
            $table->string('trans_type')->length(100);
            $table->string('passenger_name')->length(190);
            $table->string('email')->length(90);
            $table->string('contact_no')->length(60);
            $table->string('passenger_type')->length(100);
            $table->string('tax_type')->length(60);
            $table->string('fare_amount')->length(42);
            $table->string('net_amount')->length(42);
            $table->string('trans_status')->length(42);
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
        Schema::dropIfExists('transactions');
    }
};
