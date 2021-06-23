<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Todo;

class TodosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = Todo::orderBy('created_at', 'desc')->get();
        return view('todos.index')->with('todos', $todos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'text' => 'required',
        'body' => 'required',
        'due'  => 'required'
      ]);

      if ($validator->fails()) {
        $keys = array_keys($validator->messages()->getMessages());
        return redirect('/todo/create')->with('firstError', $keys[0])->withErrors($validator)->withInput();
      }      

      $todo = new Todo;
      $todo->text = $request->input('text');
      $todo->body = $request->input('body');
      $todo->due  = $request->input('due');
      $todo->save();

      return redirect('/')->with('success', 'Todo created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $todo = Todo::find($id);
        return view('todos.show')->with('todo', $todo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $todo = Todo::find($id);
      return view('todos.edit')->with('todo', $todo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $validator = Validator::make($request->all(), [
        'text' => 'required',
        'body' => 'required',
        'due'  => 'required'
      ]);

      if ($validator->fails()) {
        $keys = array_keys($validator->messages()->getMessages());
        return redirect("/todo/${id}/edit")->with('firstError', $keys[0])->withErrors($validator)->withInput();
      }      

      $todo = Todo::find($id);
      $todo->text = $request->input('text');
      $todo->body = $request->input('body');
      $todo->due  = $request->input('due');
      $todo->save();

      return redirect('/')->with('success', 'Todo updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todo = Todo::find($id);
        $todo->delete();

        return redirect('/')->with('success', 'Todo deleted.');
    }
}
