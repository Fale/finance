@extends('layout')

@section('css')
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
@stop

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
                <th><b title="((Open + Close) * Volume) / 2">Indice 1</b></th>
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
                <td>{{(($data->close + $data->open) * $data->volume) / 2}}</td>
            </tr>
        @endforeach
    </table>
@stop

@section('js')
    <script src="//cdn.jsdelivr.net/tablesorter/2.13.3/js/jquery.tablesorter.min.js"></script>
    <script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script >
        $(function() {
            $(".sortable").tablesorter();
        });
    </script>
    <script>
        $(function() {
            $( document ).tooltip();
        });
    </script>
  <style>
  label {
    display: inline-block;
    width: 5em;
  }
  </style>
@stop
