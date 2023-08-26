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
        Schema::create('tbl_patient_services', function (Blueprint $table) {
            $table->id('patient_service_id');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('service_id');
            $table->longText('comments')->nullable();
            $table->foreign('patient_id')->references('patient_id')->on('tbl_patient');
            $table->foreign('service_id')->references('service_id')->on('tbl_service');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_patient_services');
    }
};
