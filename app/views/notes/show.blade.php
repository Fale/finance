@extends('layout')

@section('content')

<h1>Show Note</h1>

<p>{{ link_to_route('notes.index', 'Return to all notes') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Title</th>
				<th>Text</th>
				<th>Market_id</th>
				<th>Stock_id</th>
				<th>Type_id</th>
				<th>Happens_on</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $note->title }}}</td>
					<td>{{{ $note->text }}}</td>
					<td>{{{ $note->market_id }}}</td>
					<td>{{{ $note->stock_id }}}</td>
					<td>{{{ $note->type_id }}}</td>
					<td>{{{ $note->happens_on }}}</td>
                    <td>{{ link_to_route('notes.edit', 'Edit', array($note->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('notes.destroy', $note->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
