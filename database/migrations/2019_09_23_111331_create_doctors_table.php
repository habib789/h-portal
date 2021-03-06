<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('department_id');
            $table->string('first_name',191);
            $table->string('last_name',191);
            $table->string('phone',15)->unique();
            $table->text('address')->nullable();
            $table->string('license',191)->nullable();
            $table->string('verify',191)->default('not-verified');
            $table->string('gender',191);
            $table->string('graduate',191);
            $table->string('experience',191);
            $table->string('degrees',191);
            $table->date('date_of_birth');
            $table->text('document');
            $table->text('image')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctors');
    }
}
