<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained();
            $table->string('sal_date')->nullable();
            $table->string('sal_month')->nullable();
            $table->integer('no_of_classes', false, false)->nullable();
            $table->decimal('security')->nullable();
            $table->decimal('net_salary')->nullable();
            $table->boolean('advance')->nullable();

            $table->foreignId('created_by')->nullable()->constrained();
            $table->foreignId('updated_by')->nullable()->constrained();
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
        Schema::dropIfExists('salaries');
    }
}
