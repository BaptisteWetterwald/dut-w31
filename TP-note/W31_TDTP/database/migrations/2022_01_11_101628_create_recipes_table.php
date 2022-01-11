<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Recipe', function (Blueprint $table) {
            $table->id('recipe_id');
            $table->integer('creator_id');
            $table->timestamps('created_at');
            $table->string('name');
            $table->integer('time_to_prepare');
            $table->string('ingredients');
            $table->string('instructions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipes');
    }
}
