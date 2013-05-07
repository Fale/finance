<?php

class ValuesController extends BaseController {

	public function importValues($symbol)
	{
		$id = Stock::where('symbol', $symbol)->pluck('id');
		$handle = fopen('http://ichart.yahoo.com/table.csv?s=' . $symbol, 'r');
		$l = 0;
        while (($data = fgetcsv($handle, 5000, ",")) !== FALSE) {
            $l ++;
            if ($l > 1)
            {
            	$datas[$data[0]]['stock_id'] = $id;
                $datas[$data[0]]['date'] = $data[0];
                $datas[$data[0]]['open'] = $data[1];
                $datas[$data[0]]['close'] = $data[4];
                $datas[$data[0]]['high'] = $data[2];
                $datas[$data[0]]['low'] = $data[3];
                $datas[$data[0]]['volume'] = $data[5];
                $datas[$data[0]]['delta'] = ( (double) $data[1] - (double) $data[4]) / (double) $data[1];
                $datas[$data[0]]['absdelta'] = ($data[2] - $data[3]) / $data[2];
            }
        }

        foreach ($datas as $data) {
        	Value::create($data);
        }
	}

}