@extends('layout')

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
                <td>{{$query->starred}}</td>
                <td>{{$query->name}}</td>
                <td>{{$query->id}}</td>
            </tr>
        @endforeach
    </table>
@stop
