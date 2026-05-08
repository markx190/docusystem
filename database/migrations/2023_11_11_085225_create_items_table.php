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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('item_id_no')->length(42);
            $table->string('item_name')->length(42);
            $table->string('brand')->length(42);
            $table->string('category')->length(42);
            $table->string('total_stock')->length(42);
            $table->string('no_of_stock_sold')->length(42);
            $table->string('remaining_sold')->length(42);
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
        Schema::dropIfExists('items');
    }
};
