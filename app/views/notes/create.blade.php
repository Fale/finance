@extends('layout')

@section('css')
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
    <style>
        .error { color: red; font-style: italic; }
    </style>
@stop

@section('content')

<h1>Create Note {{Input::get('stock') ? 'for ' . Stock::where('id', Input::get('stock'))->pluck('name') : ''}}</h1>

{{ Form::open(array('role' => 'form', 'route' => 'notes.store')) }}
    <div class="form-group">
        {{ Form::label('title', 'Title:') }}
        {{ Form::text('title', NULL, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('text', 'Text:') }}
        {{ Form::textarea('text', NULL, array('class' => 'form-control')) }}
    </div>
    @if(!Input::get('market'))
    <div class="form-group">
        {{ Form::label('market_id', 'Market:') }}
        {{ Form::select('market_id', Market::lists('name', 'id'), Input::get('market'), array('class' => 'form-control')) }}
    </div>
    @endif
    @if(!Input::get('stock'))
    <div class="form-group">
        {{ Form::label('stock_id', 'Stock:') }}
        {{ Form::select('stock_id', Stock::lists('symbol', 'id'), Input::get('stock'), array('class' => 'form-control')) }}
    </div>
    @endif
    <div class="form-group">
        {{ Form::label('type_id', 'Type:') }}
        {{ Form::select('type_id', NoteType::lists('name', 'id'), NULL, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('happens_on', 'Date:') }}
        {{ Form::text('happens_on', NULL, array('class' => 'form-control datepicker')) }}
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
