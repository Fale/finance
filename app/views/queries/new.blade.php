@extends('layout')

@section('content')
  <h1>Nuova query</h1>

  {{ Form::open(array('url' => 'queries/addFilter', 'class' => 'form-inline')) }}
    {{Form::Button('Add', array('id' => 'add', 'class' => 'btn btn-primary')) }}
    {{ Form::submit('Save', array('class' => 'btn btn-primary', 'id' => 'submit')) }}
    {{ Form::button('Delete', array('class' => 'btn btn-danger')) }}
  {{ Form::close() }}
@stop

@section('js')
  <script>
    $( "button#add" ).click(function() {
        $("input#submit").before('<div class="form-vertical"><div class="form-group">{{ Form::select('type', array( '' => '', 'HV' => 'High value', 'LV' => 'Low value', 'D' => 'Delta'), '', array('class' => 'form-control type', 'onChange' => 'loadInputs(this)'))}}</div></div>');
        console.log('clicked!')
    });

    function loadInputs(item) {
      console.log('changed!')
      if($(item).val() == 'HV'){
        $(item).parent().parent().append('<div class="form-group">{{ Form::select('sign', array('>', '=', '<', '=>', '<='), '', array('class' => 'form-control')) }}</div>');
        $(item).parent().parent().append('<div class="form-group">{{ Form::text('value', '', array('class' => 'form-control')) }}</div>');
        console.log($(item).val())
      if($(item).val() == 'LV'){
        $(item).parent().parent().append('<div class="form-group">{{ Form::select('sign', array('>', '=', '<', '=>', '<='), '', array('class' => 'form-control')) }}</div>');
        $(item).parent().parent().append('<div class="form-group">{{ Form::text('value', '', array('class' => 'form-control')) }}</div>');
        console.log($(item).val())
      if($(item).val() == 'D'){
        $(item).parent().parent().append('<div class="form-group">{{ Form::select('sign', array('>', '=', '<', '=>', '<='), '', array('class' => 'form-control')) }}</div>');
        $(item).parent().parent().append('<div class="form-group">{{ Form::text('value', '', array('class' => 'form-control')) }}</div>');
        console.log($(item).val())
      }
        console.log($(item).val())
    };
  </script>
@stop
