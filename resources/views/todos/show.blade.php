@extends('layouts.app')

@section('title')
  Show Item
@endsection

@section('content')
  <a href="/" class="btn btn-default">Go Back</a>
  <h1>{{$todo->text}}</h1>
  <div class="label label-danger">{{$todo->due}}</div>
  <hr />
  <p>{{$todo->body}}</p>
  <div>
    <a href="/todo/{{$todo->id}}/edit" class="btn btn-default">Edit</a>
    {!! Form::open(['action' => ['TodosController@destroy', $todo->id], 'method' => 'post', 'class' => 'pull-right']) !!}
      {{ Form::hidden('_method', 'DELETE') }}
      {{ Form::bsSubmit('Delete', ['class' => 'btn btn-danger']) }}
    {!! Form::close() !!}   
  </div>
@endsection