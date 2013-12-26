@extends('layout')

@section('content')
  <h1>Nuova query</h1>

  {{ Form::open(array('url' => 'queries/new', 'class' => 'form-inline')) }}
    {{Form::Button('Add', array('id' => 'add', 'class' => 'btn btn-primary')) }}
    {{ Form::submit('Save', array('class' => 'btn btn-primary', 'id' => 'submit')) }}
    {{ Form::button('Delete', array('class' => 'btn btn-danger')) }}
  {{ Form::close() }}
@stop

@section('js')
  <script>
    var i = 0;
    $( "button#add" ).click(function() {
        $("input#submit").before('<div class="form-vertical"><div class="form-group">{{ HTML::Decode(Form::select('filters[\' + i + \'].type', array( '' => '', 'HV' => 'High value', 'LV' => 'Low value', 'D' => 'Delta'), '', array('class' => 'form-control type', 'onChange' => 'loadInputs(this, i)')))}}</div></div>');
        i++;
    });

    function loadInputs(item, index) {
      console.log('changed!')
      if($(item).val() == 'HV'){
{{--        $(item).parent().parent().append('<div class="form-group">{{ Form::select(HTML::Decode('filters.["\'index\']_sign'), array('>', '=', '<', '=>', '<='), '', array('class' => 'form-control')) }}</div>'); The following is the crappy workaround for this --}}
        $(item).parent().parent().append('<div class="form-group"><select class="form-control" name="filters[' + index + '].sign"><option value="0">&gt;</option><option value="1">=</option><option value="2">&lt;</option><option value="3">=&gt;</option><option value="4">&lt;=</option></select></div>');
        $(item).parent().parent().append('<div class="form-group">{{ HTML::Decode(Form::text('filters[\' + index + \'].value', '', array('class' => 'form-control'))) }}</div>');
      }
      if($(item).val() == 'LV'){
        $(item).parent().parent().append('<div class="form-group"><select class="form-control" name="filters[' + index + '].sign"><option value="0">&gt;</option><option value="1">=</option><option value="2">&lt;</option><option value="3">=&gt;</option><option value="4">&lt;=</option></select></div>');
        $(item).parent().parent().append('<div class="form-group">{{ HTML::Decode(Form::text('filters[\' + index + \'].value', '', array('class' => 'form-control'))) }}</div>');
      }
      if($(item).val() == 'D'){
        $(item).parent().parent().append('<div class="form-group"><select class="form-control" name="filters[' + index + '].sign"><option value="0">&gt;</option><option value="1">=</option><option value="2">&lt;</option><option value="3">=&gt;</option><option value="4">&lt;=</option></select></div>');
        $(item).parent().parent().append('<div class="form-group">{{ HTML::Decode(Form::text('filters[\' + index + \'].value', '', array('class' => 'form-control'))) }}</div>');
      }
    };
  </script>
@stop
