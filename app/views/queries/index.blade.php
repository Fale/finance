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
    $( "span.glyphicon-star-empty" ).click(function() {
        $.ajax({
          type: "POST",
          url: "/queries/star",
          data: { id: $(this).attr('id') }
        })
          .done(function( msg ) {
            $(this).removeClass('glyphicon-star-empty')
            $(this).addClass('glyphicon-star')
          });
    });
    $( "span.glyphicon-star" ).click(function() {
        $.ajax({
          type: "POST",
          url: "/queries/unstar",
          data: { id: $(this).attr('id') }
        })
          .done(function( msg ) {
            $(this).removeClass('glyphicon-star')
            $(this).addClass('glyphicon-star-empty')
          });
    });
  </script>
@stop
