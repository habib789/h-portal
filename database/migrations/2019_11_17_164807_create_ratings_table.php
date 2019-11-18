<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('appointment_id');
            $table->unsignedBigInteger('doctor_id');
            $table->integer('rating_star');
            $table->string('review');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('appointment_id')->references('id')->on('appointments')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('ratings');
    }
}
