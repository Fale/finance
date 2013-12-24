@extends('layout')

@section('content')
    <table class="table table-striped sortable">
        <thead>
            <tr>
                <th>Symbol</th>
                <th>Date</th>
                <th>Open</th>
                <th>Close</th>
                <th>Delta</th>
                <th>Low</th>
                <th>High</th>
                <th>Delta</th>
                <th>Volume</th>
            </tr>
        </thead>
        @foreach ($datas as $data)
            <tr>
                <td>{{$data->stock->symbol}}</td>
                <td>{{$data->date}}</td>
                <td>{{$data->open}}</td>
                <td>{{$data->close}}</td>
                <td>{{$data->delta}}</td>
                <td>{{$data->low}}</td>
                <td>{{$data->high}}</td>
                <td>{{$data->absdelta}}</td>
                <td>{{$data->volume}}</td>
            </tr>
        @endforeach
    </table>
@stop
