@extends('layouts.app')

@section('title')
  Create Item
@endsection

@section('content')
  <h1>Create Todo</h1>
  {!! Form::open(['action' => 'TodosController@store', 'method' => 'post']) !!}
    {{ Form::bsText('text', null, ['placeholder' => 'Enter text']) }}
    {{ Form::bsTextarea('body', null, ['placeholder' => 'Enter body']) }}
    {{ Form::bsText('due', null, ['placeholder' => 'Enter due date']) }}
    {{ Form::bsSubmit(null, ['class' => 'btn btn-primary']) }}
  {!! Form::close() !!} 
@endsection