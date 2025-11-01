<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelationshipAppliedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relationship_applied', function (Blueprint $table) {
           $table->id();
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('rel_id');
            $table->unsignedBigInteger('user_id');
            $table->boolean('applied')->default(false);
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
        Schema::dropIfExists('relationship_applied');
    }
}
