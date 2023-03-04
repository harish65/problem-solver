<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolutionFunctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solution_functions', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default("0");
            $table->string('file');
            $table->integer('problem_id')->nullable()->unsigned();            
            $table->integer('solution_id')->nullable()->unsigned();          
            $table->integer('user_id')->nullable()->unsigned();
            $table->enum('validation_first', ['0', '1'])->default("0");
            $table->enum('validation_second', ['0', '1'])->default("0");            
            $table->string('name');
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
        Schema::dropIfExists('solution_functions');
    }
}
