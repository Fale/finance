@extends('layout')

@section('css')
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
    <style type="text/css">
        th.tablesorter-headerAsc {
            background: #EEE;
        }

        th.tablesorter-headerDesc {
            background: #EEE;
        }

        th.tablesorter-header {
            background-image: url(http://cdn.jsdelivr.net/tablesorter/2.13.3/css/images/ice-unsorted.gif);
            cursor: pointer;
            background-repeat: no-repeat;
            background-position: center right;
            padding-right: 20px;
        }

        label {
            display: inline-block;
            width: 5em;
        }

        .tableFloatingHeaderOriginal th { background-color: #fff; border-bottom: 1px solid #DDD;}
    </style>
@stop

@section('content')
    <table class="table table-striped sortable">
        <thead>
            <tr>
                <th>Date</th>
                <th>Open</th>
                <th>Close</th>
                <th>Delta %</th>
                <th>Low</th>
                <th>High</th>
                <th>Delta %</th>
                <th>Volume</th>
                <th title="((Open + Close) * Volume) / 2 / 5000">Index A</th>
            </tr>
        </thead>
        @foreach ($datas as $data)
            <tr>
                <td>{{$data->date}}</td>
                <td>{{$data->open}}</td>
                <td>{{$data->close}}</td>
                <td>{{round($data->delta, 2)}}</td>
                <td>{{$data->low}}</td>
                <td>{{$data->high}}</td>
                <td>{{round($data->absdelta, 2)}}</td>
                <td>{{$data->volume}}</td>
                <td>{{floor((($data->close + $data->open) * $data->volume) / 2 / 5000)}}</td>
            </tr>
        @endforeach
    </table>
@stop

@section('js')
    <script src="//cdn.jsdelivr.net/tablesorter/2.13.3/js/jquery.tablesorter.min.js"></script>
    <script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script src="/jquery.stickytableheaders.min.js"></script>
    <script >
        $(function() {
            $(".sortable").tablesorter();
        });

        $(function() {
            $( document ).tooltip();
        });

        $('table').stickyTableHeaders({fixedOffset: 50});
    </script>
@stop
