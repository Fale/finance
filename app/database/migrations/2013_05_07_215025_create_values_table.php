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
            $table->decimal('open', 9, 5);
            $table->decimal('close', 9, 5);
            $table->decimal('high', 9, 5);
            $table->decimal('low', 9, 5);
            $table->integer('volume')->unsigned();
            $table->decimal('delta', 9, 5);
            $table->decimal('absdelta', 9, 5);
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
