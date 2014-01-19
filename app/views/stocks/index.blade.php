@extends('layout')

@section('content')
    <ul>
        @foreach ($stocks as $stock)
            <li>{{link_to('stock/' . $stock->symbol, $stock->symbol . ': ' . $stock->name)}}</li>
        @endforeach
    </ul>
@stop

