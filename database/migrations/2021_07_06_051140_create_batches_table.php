<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batches', function (Blueprint $table) {
            $table->id();
            $table->string('batch_name', 30)->nullable();
            $table->string('sh_title', 20)->nullable();
            
            $table->bigInteger('session_id')->nullable();
            $table->bigInteger('shift_id')->nullable();
            $table->timestamps();

            $table->foreign('session_id')
            ->references('id')
            ->on('courses')
            ->onDelete('cascade');
            $table->foreign('shift_id')
            ->references('id')
            ->on('shifts')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('batches');
    }
}
