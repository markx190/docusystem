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
        Schema::create('bz_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id_no')->length(42);
            $table->string('item_id_no')->length(42);
            $table->string('quantity')->length(42);
            $table->string('total_amount')->length(42);
            $table->string('payment_method')->length(42);
            $table->string('response_code')->length(42);
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
        Schema::dropIfExists('bz_orders');
    }
};
