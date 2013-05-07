<?php

use Illuminate\Database\Migrations\Migration;

class CreateValuesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('values', function($table) {
            $table->increments('id');
            $table->integer('stock_id')->unsigned();
            $table->date('date');
            $table->integer('open');
            $table->integer('close');
            $table->integer('high');
            $table->integer('low');
            $table->integer('volume')->unsigned();
            $table->integer('delta');
            $table->integer('absdelta');
            $table->foreign('stock_id')->references('id')->on('stocks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('values');
    }

}