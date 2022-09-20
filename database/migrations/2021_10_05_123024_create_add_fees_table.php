<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_fees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->nullable()->constrained();
            $table->foreignId('feetype_id')->nullable()->constrained();
            $table->decimal('amount');
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
        Schema::dropIfExists('add_fees');
    }
}
