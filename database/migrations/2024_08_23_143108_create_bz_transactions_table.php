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
        Schema::create('bz_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->length(120);
            $table->string('session_id')->length(60);
            $table->string('firstname')->length(220);
            $table->string('lastname')->length(220);
            $table->string('email')->length(120);
            $table->string('mobile_number')->length(60);
            $table->string('buyer_type')->length(60);
            $table->string('lot_no')->length(120);
            $table->string('street')->length(120);
            $table->string('barangay')->length(120);
            $table->string('city')->length(120);
            $table->string('province')->length(120);
            $table->string('status')->length(120);
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
        Schema::dropIfExists('bz_transactions');
    }
};
