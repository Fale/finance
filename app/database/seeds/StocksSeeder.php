<?php

class StocksSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
        $handle = fopen('data/nasdaq.csv', 'r');
        $datas = Array();
        $l = 0;
        while (($data = fgetcsv($handle, 5000, ",")) !== FALSE) {
            $l ++;
            if ($l > 1)
            {
            	$datas[$data[0]]['market_id'] = 1;
                $datas[$data[0]]['symbol'] = $data[0];
                $datas[$data[0]]['name'] = $data[1];
                $datas[$data[0]]['sector'] = $data[6];
                $datas[$data[0]]['industry'] = $data[7];
                $datas[$data[0]]['url'] = $data[8];
            }
        }

        foreach ($datas as $data)
            Stock::create($data);
	}

}