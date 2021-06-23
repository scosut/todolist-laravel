@extends('layouts.app')

@section('title')
  Create Item
@endsection

@section('content')
  <a href="/todo/{{$todo->id}}" class="btn btn-default">Go Back</a>
  <h1>Edit Todo</h1>
  {!! Form::open(['action' => ['TodosController@update', $todo->id], 'method' => 'post']) !!}
    {{ Form::bsText('text', $errors->has('text') ? old('text') : $todo->text) }}
    {{ Form::bsTextarea('body', $errors->has('body') ? old('body') : $todo->body) }}
    {{ Form::bsText('due', $errors->has('due') ? old('due') : $todo->due) }}
    {{ Form::hidden('_method', 'PUT') }}
    {{ Form::bsSubmit(null, ['class' => 'btn btn-primary']) }}
  {!! Form::close() !!} 
@endsection