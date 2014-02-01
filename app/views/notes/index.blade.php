@extends('layout')

@section('content')

<h1>All Notes</h1>

<p>{{ link_to_route('notes.create', 'Add new note') }}</p>

@if ($notes->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Title</th>
				<th>Market</th>
				<th>Stock</th>
				<th>Type</th>
				<th>Date</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($notes as $note)
				<tr>
					<td>{{{ $note->title }}}</td>
					<td>{{{ $note->market->name }}}</td>
					<td>{{ link_to('/stock/' . $note->stock->symbol, $note->stock->symbol) }}</td>
					<td>{{{ $note->type->name }}}</td>
					<td>{{ Carbon::parse($note->happens_on)->format('d/m/Y') }}</td>
                    <td>{{ link_to_route('notes.edit', 'Edit', array($note->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('notes.destroy', $note->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
    {{ $notes->links() }}
@else
	There are no notes
@endif

@stop
