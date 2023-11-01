<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
              $table->bigInteger('country_id')->unsigned()->index()->nullable();
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->bigInteger('language_id')->unsigned()->index()->nullable();
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');
            $table->bigInteger('level_id')->unsigned()->index()->nullable();
            $table->foreign('level_id')->references('id')->on('levels')->onDelete('cascade');

            $table->bigInteger('subject_id')->unsigned()->index()->nullable();
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');

            $table->bigInteger('sub_subject_id')->unsigned()->index()->nullable();
            $table->foreign('sub_subject_id')->references('id')->on('sub_subjects')->onDelete('cascade');

            $table->string('first_name',60);
            $table->string('last_name',60);
            $table->string('email',100);
            $table->string('hourly_rate',10);
            $table->text('teaching_experience')->nullable();
            $table->text('current_situation')->nullable();
            $table->string('phone',20);
            $table->string('tutor_image',100)->nullable();
            $table->string('otp_verified',10)->default('no');
            $table->string('status',10)->default('inactive');
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
        Schema::dropIfExists('teachers');
    }
}
