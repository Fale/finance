@extends('layout')

@section('content')
    @foreach(Note::orderBy('happens_on')->get() as $note)
        <div class="bs-callout bs-callout-info">
            <h4>{{{Carbon::parse($note->happens_on)->format('d/m/Y')}}} - {{{$note->stock->symbol}}} - {{{$note->title}}}</h4>
            <p>{{{$note->text}}}</p>
        </div>
    @endforeach
@stop
