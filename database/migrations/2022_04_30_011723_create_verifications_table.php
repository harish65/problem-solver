<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verifications', function (Blueprint $table) {
            $table->id();            
            $table->integer('verification_type_id')->unsigned();            
            $table->integer('verification_type_text_id')->unsigned();            
            $table->integer('problem_id')->unsigned();            
            $table->integer('solution_id')->unsigned();            
            $table->integer('solution_function_id')->unsigned();            
            $table->integer('user_id')->unsigned();
            $table->string('key')->nullable();
            $table->string('val')->nullable();
            $table->string('type')->nullable();
            $table->string('file')->nullable();
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
        Schema::dropIfExists('verifications');
    }
}
