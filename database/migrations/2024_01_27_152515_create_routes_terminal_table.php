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
        Schema::create('routes_terminal', function (Blueprint $table) {
            $table->id();
            $table->string('route_id_no')->length(42);
            $table->string('route_name')->length(190);
            $table->string('terminal')->length(192);
            $table->string('terminal_address')->length(200);
            $table->string('direction')->length(190);
            $table->string('province')->length(190);
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
        Schema::dropIfExists('routes_terminal');
    }
};
