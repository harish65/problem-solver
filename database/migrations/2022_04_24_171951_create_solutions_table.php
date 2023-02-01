<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solutions', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default("0");
            $table->string('file');
            $table->unsignedBigInteger('user_id')->nullable()->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('problem_id')->nullable()->unsigned();
            $table->foreign('problem_id')->references('id')->on('problems');
            $table->unsignedBigInteger('solution_type_id')->nullable()->unsigned();
            $table->foreign('solution_type_id')->references('id')->on('solution_types');
            $table->string('name');
            $table->string('state')->default("1");
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
        Schema::dropIfExists('solutions');
    }
}
