@extends('layout')

@section('content')
    @foreach(Note::where('happens_on', '>=', Carbon::now())->orderBy('happens_on')->orderBy('stock_id')->get() as $note)
        <div class="bs-callout note-{{$note->type->html}}">
            <h4>
                {{{Carbon::parse($note->happens_on)->format('d/m/Y')}}} - 
                {{link_to('stock/' . $note->stock->symbol, $note->stock->symbol)}} -
                {{{$note->title}}}
            </h4>
            <p>{{{$note->text}}}</p>
        </div>
    @endforeach
@stop
