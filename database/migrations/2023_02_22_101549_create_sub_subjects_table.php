<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_subjects', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sub_id')->unsigned()->index()->nullable();
            $table->foreign('sub_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->string('sub_sub_name',100);
            $table->string('sub_sub_slug',100);
            $table->string('deleted',10)->default('no');
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
        Schema::dropIfExists('sub_subjects');
    }
}
