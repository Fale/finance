<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class EditValuesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('values', 'delta'))
            Schema::table('values', function(Blueprint $table) {
                $table->renameColumn('delta', 'ocdelta');
            });

        Schema::table('values', function(Blueprint $table) {
            $table->decimal('delta', 11, 5)->nullable();
            $table->integer('indexa')->unsigned()->default(0);
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
