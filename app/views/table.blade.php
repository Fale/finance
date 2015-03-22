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
    <div class="bs-callout bs-callout-info">
        <h4>Customize your table</h4>
        <p> You can change this query in the following methods:
        <ul>
            <li>?percentile=NUMBER (default: 10) change the percentile of threshold</li>
            <li>?from=DATE (default: {{Carbon::now()->subWeek()->format('Y-m-d')}}) date since the stocks will appear</li>
            <li>?to=DATE (default: {{Carbon::now()->format('Y-m-d')}}) date until the stocks will appear</li>
            <li>?volume=NUMBER (default: 1 000 000) minimum daily volume for the stock to appear</li>
            <li>?indexa=NUMBER (default: 50) minimum Index A value for the stock to appear</li>
        </ul>
        If you want to set more than a value you can use ?VAR1=VAL1&amp;VAR2=VAL2&amp;VAR3=VAL3...
        </p>
    </div>
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
                <th title="((Open + Close) * Volume) / 2 / 5000">Index A</th>
            </tr>
        </thead>
        @foreach ($datas as $data)
            <tr>
                <td>{{link_to('stock/' . $data->stock->symbol, $data->stock->symbol)}}</td>
                <td>{{$data->date}}</td>
                <td>{{$data->open}}</td>
                <td>{{$data->close}}</td>
                <td>{{$data->ocdelta}}</td>
                <td>{{$data->low}}</td>
                <td>{{$data->high}}</td>
                <td>{{$data->absdelta}}</td>
                <td>{{$data->volume}}</td>
                <td>{{$data->indexa}}</td>
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
