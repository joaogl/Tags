<?php

use Illuminate\Database\Migrations\Migration;
use \jlourenco\base\Database\Blueprint;

class CreateTagsTables extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('TagCategory', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('description', 250)->nullable();

            $table->timestamps();
            $table->softDeletes();
            $table->creation();
        });

        Schema::create('Tag', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('description', 250)->nullable();

            $table->timestamps();
            $table->softDeletes();
            $table->creation();
        });

        Schema::create('Tag_TagCategory', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('tag')->unsigned();
            $table->integer('tagcategory')->unsigned();

            $table->foreign('tag')->references('id')->on('Tag');
            $table->foreign('tagcategory')->references('id')->on('TagCategory');
        });

        Schema::create('Tag_Entity', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('tag')->unsigned();
            $table->morphs("entity");

            $table->timestamps();
            $table->softDeletes();
            $table->creation();

            $table->foreign('tag')->references('id')->on('Tag');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::drop('Tag_Entity');
        Schema::drop('Tag_TagCategory');
        Schema::drop('Tag');
        Schema::drop('TagCategory');

    }

}
