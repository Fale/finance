<?php

class MarketsSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Market::create(array(
            'id' => 1,
            'name' => 'NASDAQ',
            'code' => 'NASDAQ',
        ));

    }

}
