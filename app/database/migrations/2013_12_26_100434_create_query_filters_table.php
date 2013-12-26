<?php

use Illuminate\Database\Migrations\Migration;

class CreateQueryFiltersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('query_filters', function($table){
            $table->increments('id');
            $table->integer('query_id')->unsigned();
            $table->string('type');
            $table->string('parameters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('query_filters');
    }

}