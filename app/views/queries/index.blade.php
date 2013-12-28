@extends('layout')

@section('css')
    <style type="text/css">
        span.star {
            cursor: pointer;
        }
    </style>
@stop

@section('content')
    {{HTML::link('/queries/new/', 'Nuova', 'class="btn btn-primary btn-large"')}}

    <table class="table table-striped sortable">
        <thead>
            <tr>
                <th>Starred</th>
                <th>Name</th>
                <th>Esegui</th>
            </tr>
        </thead>
        @foreach ($queries as $query)
            <tr>
                <td>
                    <span id="{{$query->id}}" class="star glyphicon glyphicon-star{{(!$query->starred) ? "-empty" : ""}}"></span>
                </td>
                <td>{{$query->name}}</td>
                <td>{{$query->id}}</td>
            </tr>
        @endforeach
    </table>
@stop

@section('js')
  <script>
    $('body').on('click', 'span.glyphicon-star-empty', function() {
        $.ajax({
          type: "PUT",
          url: "/queries/star",
          data: { id: $(this).attr('id') }
        })
          .done(function(i) {
            $("span#" + i).removeClass('glyphicon-star-empty');
            $("span#" + i).addClass('glyphicon-star');
          });
    });
    $('body').on('click', 'span.glyphicon-star', function() {
        $.ajax({
          type: "PUT",
          url: "/queries/unstar",
          data: { id: $(this).attr('id') }
        })
          .done(function(i) {
            $("span#" + i).removeClass('glyphicon-star');
            $("span#" + i).addClass('glyphicon-star-empty');
          });
    });
  </script>
@stop
