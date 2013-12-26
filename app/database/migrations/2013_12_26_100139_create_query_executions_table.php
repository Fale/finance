<?php

use Illuminate\Database\Migrations\Migration;

class CreateQueryExecutionsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('query_executions', function($table){
            $table->increments('id');
            $table->integer('query_id')->unsigned();
            $table->string('name');
            $table->integer('executed_by')->unsigned();
            $table->timestamp('executed_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('query_executions');
    }

}