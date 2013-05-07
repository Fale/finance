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
            $table->decimal('open', 5, 2);
            $table->decimal('close', 5, 2);
            $table->decimal('high', 5, 2);
            $table->decimal('low', 5, 2);
            $table->integer('volume')->unsigned();
            $table->decimal('delta', 5, 2);
            $table->decimal('absdelta', 5, 2);
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