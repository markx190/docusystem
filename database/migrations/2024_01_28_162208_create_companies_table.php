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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('comp_id_no')->length(190);
            $table->string('company_name')->length(190);
            $table->string('tin_no')->length(90);
            $table->string('office_address')->length(190);
            $table->string('services')->length(100);
            $table->string('contact_personel')->length(100);
            $table->string('status')->length(100);
            $table->string('created_by')->length(100);
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
        Schema::dropIfExists('companies');
    }
};
