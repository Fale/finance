@extends('layout')

@section('css')
    <style type="text/css">
        h1 a {
            float: right;
        }
    </style>
@stop

@section('content')
    <h1>
        {{$stock->symbol}}: {{$stock->name}} ({{$stock->sector}})
        {{link_to('/notes/create?market=' . $stock->market->id . '&stock=' . $stock->id, 'Add note', array('class' => 'btn btn-primary btn-large'))}}
    </h1>
    @foreach ($notes as $note)
        <div class="bs-callout note-{{$note->type->html}}">
            <h4>{{{Carbon::parse($note->happens_on)->format('d/m/Y')}}} - {{{$note->title}}}</h4>
            <p>{{{$note->text}}}</p>
        </div>
    @endforeach
@stop
