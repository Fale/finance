@extends('layouts.scaffold')

@section('main')

<h1>Edit Note</h1>
{{ Form::model($note, array('method' => 'PATCH', 'route' => array('notes.update', $note->id))) }}
	<ul>
        <li>
            {{ Form::label('title', 'Title:') }}
            {{ Form::text('title') }}
        </li>

        <li>
            {{ Form::label('text', 'Text:') }}
            {{ Form::textarea('text') }}
        </li>

        <li>
            {{ Form::label('market_id', 'Market_id:') }}
            {{ Form::input('number', 'market_id') }}
        </li>

        <li>
            {{ Form::label('stock_id', 'Stock_id:') }}
            {{ Form::input('number', 'stock_id') }}
        </li>

        <li>
            {{ Form::label('type_id', 'Type_id:') }}
            {{ Form::input('number', 'type_id') }}
        </li>

        <li>
            {{ Form::label('happens_on', 'Happens_on:') }}
            {{ Form::text('happens_on') }}
        </li>

		<li>
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('notes.show', 'Cancel', $note->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
