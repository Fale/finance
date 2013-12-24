@extends('layout')

@section('content')
    <script src="//cdn.jsdelivr.net/tablesorter/2.13.3/js/jquery.tablesorter.min.js"></script>
    <script >
        $(function() {
            $("table#sortTableExample").tablesorter({ sortList: [[1,0]] });
        });
    </script>
    <table class="zebra-striped">
        <thead>
            <td>Symbol</td>
            <td>Date</td>
            <td>Delta</td>
        </thead>
        @foreach ($datas as $data)
            <tr>
                <td>{{$data->symbol}}</td>
                <td>{{$data->date}}</td>
                <td>{{$data->delta}}</td>
            </tr>
        @endforeach
    </table>
@stop