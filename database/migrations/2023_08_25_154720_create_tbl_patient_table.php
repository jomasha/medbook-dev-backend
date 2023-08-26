<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tbl_patient', function (Blueprint $table) {
            $table->id('patient_id');
            $table->string('name', 50);
            $table->string('birth_date');
            $table->unsignedBigInteger('gender_id');
            $table->foreign('gender_id')->references('gender_id')->on('tbl_gender');
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_patient');
    }
};
