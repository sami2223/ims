<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClasswiseSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classwise_salaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('salary_id')->constrained();
            $table->decimal('class_amount');
            $table->integer('no_of_classes', false, false);
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
        Schema::dropIfExists('classwise_salaries');
    }
}
