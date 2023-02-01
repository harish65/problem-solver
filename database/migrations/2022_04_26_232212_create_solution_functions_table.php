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
            $table->unsignedBigInteger('problem_id')->nullable()->unsigned();
            $table->foreign('problem_id')->references('id')->on('problems');
            $table->unsignedBigInteger('solution_id')->nullable()->unsigned();
            $table->foreign('solution_id')->references('id')->on('solutions');
            $table->unsignedBigInteger('user_id')->nullable()->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
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
