<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableNews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('id_journalist')->unsigned();
            $table->foreign('id_journalist')->references('id')->on('journalists');
            $table->integer('id_type_news')->unsigned();;
            $table->foreign('id_type_news')->references('id')->on('type_news');
            $table->string('title');
            $table->string('description');
            $table->longText('body');
            $table->string('image');            
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
        Schema::dropIfExists('news');
    }
}
