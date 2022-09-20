<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('course')->nullable();
            $table->string('duration')->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->unsignedBigInteger('teacher_id')->nullable();
            $table->unsignedBigInteger('course_id')->nullable();
            $table->timestamps();

            $table->foreign('teacher_id')->references('id')->on('employees')->onDelete('set null');
            $table->foreign('course_id')->references('id')->on('course_names')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
