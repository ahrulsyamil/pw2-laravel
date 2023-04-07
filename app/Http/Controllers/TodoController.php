<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $all_todos = Todo::orderBy('created_at', 'desc')->get();
        $active_todos = Todo::where('is_completed', false)->orderBy('created_at', 'desc')->get();
        $completed_todos = Todo::where('is_completed', true)->orderBy('created_at', 'desc')->get();

        return view("todos.index", compact('all_todos', 'active_todos', 'completed_todos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required'
        ], [
            'name.required' => 'Nama tugas wajib diisi'
        ]);

        Todo::create($request->all());

        return redirect()->route('todos.index')->with('success', 'Data berhasil disimpan.');
    }

    public function update($id)
    {
        Todo::find($id)->update([
            'is_completed' => true
        ]);

        return redirect()->route('todos.index')->with('success', 'Data berhasil diupdate.');
    }

    public function destroy($id)
    {
        Todo::find($id)->delete();

        return redirect()->route('todos.index')->with('success', 'Data berhasil dihapus.');
    }
}
