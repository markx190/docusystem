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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('emp_id_no')->length(42);
            $table->string('company')->length(90);
            $table->string('firstname')->length(120);
            $table->string('middlename')->length(120);
            $table->string('lastname')->length(120);
            $table->string('position')->length(120);
            $table->string('contact_no')->length(60);
            $table->string('emp_email')->length(90);
            $table->string('emp_avatar')->length(190);
            $table->string('status')->length(60);
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
        Schema::dropIfExists('employees');
    }
};
