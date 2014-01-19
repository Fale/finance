@extends('layout')

@section('css')
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
    <style>
        .error { color: red; font-style: italic; }
    </style>
@stop

@section('content')

<h1>Create Note</h1>

{{ Form::open(array('role' => 'form', 'route' => 'notes.store')) }}
    <div class="form-group">
        {{ Form::label('title', 'Title:') }}
        {{ Form::text('title', '', array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('text', 'Text:') }}
        {{ Form::textarea('text', '', array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('market_id', 'Market:') }}
        {{ Form::select('market_id', Market::lists('name', 'id'), '', array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('stock_id', 'Stock:') }}
        {{ Form::select('stock_id', Stock::lists('symbol', 'id'), '', array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('type_id', 'Type:') }}
        {{ Form::select('type_id', NoteType::lists('name', 'id'), '', array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('happens_on', 'Date:') }}
        {{ Form::text('happens_on', '', array('class' => 'form-control datepicker')) }}
    </div>
    <div class="form-group">
        {{ Form::submit('Submit', array('class' => 'btn btn-info')) }}
    </div>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop


@section('js')
    <script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script>
        $(function() {
            $(".datepicker").datepicker({ dateFormat: "yy-mm-dd" });
        });
    </script>
@stop
