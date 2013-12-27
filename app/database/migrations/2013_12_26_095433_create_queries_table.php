<?php

use Illuminate\Database\Migrations\Migration;

class CreateQueriesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('queries', function($table){
            $table->increments('id');
            $table->integer('owner_id')->unsigned();
            $table->boolean('starred');
            $table->string('name');
            $table->string('filters');
            $table->integer('execution_times')->unsigned();
            $table->timestamp('last_executed_at');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('queries');
    }

}
