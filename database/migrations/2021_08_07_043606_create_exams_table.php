<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('student_exam_id')->nullable();
            $table->unsignedBigInteger('exam_type_id');
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('session_id');
            $table->unsignedBigInteger('shift_id');
            $table->string('description', 99)->nullable();
            $table->string('exam_date', 30)->nullable();
            $table->timestamps();

            // $table->foreign('student_exam_id')
            //     ->references('id')
            //     ->on('student_exam')
            //     ->onDelete('set null');
            $table->foreign('exam_type_id')
                ->references('id')
                ->on('exam_types')
                ->onDelete('set null');
                $table->foreign('session_id')
                ->references('id')
                ->on('sessions')
                ->onDelete('set null');
                $table->foreign('course_id')
                ->references('id')
                ->on('courses')
                ->onDelete('set null');

                $table->foreign('shift_id')
                ->references('id')
                ->on('shifts')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exams');
    }
}
