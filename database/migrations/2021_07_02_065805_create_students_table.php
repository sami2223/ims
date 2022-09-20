<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id('id');
            $table->string('reg_no')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('bloodgroup')->nullable();
            $table->string('religion')->nullable();
            $table->string('image')->nullable();
            $table->string('address')->nullable();
            $table->string('city',50)->nullable();
            $table->string('nationality')->nullable();
            $table->string('mobile')->nullable();
            $table->string('biometric_id')->nullable();
            $table->string('email')->nullable();
            $table->string('father_contact')->nullable();
            $table->string('yoj')->nullable();
            $table->string('yol')->nullable();
            $table->integer('code')->nullable();
            $table->unsignedInteger('course_id')->nullable();
            $table->unsignedInteger('session_id')->nullable();
            $table->unsignedInteger('batch_id')->nullable();
            $table->unsignedInteger('shift_id')->nullable();
            $table->timestamps();
            
            $table->foreign('batch_id')
                ->references('id')
                ->on('batches')
                ->onDelete('set null');

            $table->foreign('shift_id')
                ->references('id')
                ->on('shifts')
                ->onDelete('set null');
            
            $table->foreign('course_id')
                ->references('id')
                ->on('courses')
                ->onDelete('set null');
                
            $table->foreign('session_id')
                ->references('id')
                ->on('sessions')
                ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
}
