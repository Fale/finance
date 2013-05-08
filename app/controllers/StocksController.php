<?php

class StocksController extends BaseController {

	public function getImport($market, $symbol)
	{
		$id = Stock::where('symbol', $symbol)->pluck('id');
		$handle = fopen('http://ichart.yahoo.com/table.csv?s=' . $symbol, 'r');
		$l = 0;
        while (($data = fgetcsv($handle, 5000, ",")) !== FALSE) {
            $l ++;
            if ($l == 1)
                continue;
       	    $datas[$data[0]]['stock_id'] = (int) $id;
            $datas[$data[0]]['date'] = $data[0];
            $datas[$data[0]]['open'] = Value::toInt($data[1]);
            $datas[$data[0]]['close'] = Value::toInt($data[4]);
            $datas[$data[0]]['high'] = Value::toInt($data[2]);
            $datas[$data[0]]['low'] = Value::toInt($data[3]);
            $datas[$data[0]]['volume'] = (int) $data[5];
            $delta = (Value::toInt($data[4]) - Value::toInt($data[1])) / Value::toInt($data[1]);
            $datas[$data[0]]['delta'] = (int) ($delta * 10000);
            $absdelta = (Value::toInt($data[2]) - Value::toInt($data[3])) / Value::toInt($data[2]);
            $datas[$data[0]]['absdelta'] = (int) ($absdelta * 10000);
        }

        $present = Value::where('stock_id', $id)->lists('id', 'date');

        $real = array_diff_key($datas, $present);
        foreach ($real as $data) {
        	Value::create($data);
        }
        return count($real);
	}

    public function getPeaks($market, $percentile, $date = '1900-01-01')
    {
        if ($percentile >= 0)
            $values = Value::where('delta', '>=', $percentile * 100)->where('date', '>=', $date)->get();
        else
            $values = Value::where('delta', '<=', $percentile * 100)->where('date', '>=', $date)->get();

        foreach ($values as $value)
        {
            echo $value->stock->symbol . ' ';
            echo $value->date . ' ';
            echo Value::toDouble($value->delta);
            echo "<br>";
        }
    }
}