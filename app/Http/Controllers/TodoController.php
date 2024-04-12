<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    // Get all todos
    function getTodos()
    {
        // $query = Todo::query();
    
        // // If search query is provided, filter todos based on it
        // $searchQuery = request()->search ?? null;
        // if ($searchQuery !== null) {
        //     $query->where('title', 'like', '%' . $searchQuery . '%');
        // }
    
        // // Separate pending and completed todos
        // $pending_todos = $query->where('status', 'pending')->latest()->get();
        // $completed_todos = $query->where('status', 'completed')->latest()->get();
        
        $pending_todos = Todo::where('status', 'pending')->latest()->get();
        $completed_todos = Todo::where('status', 'completed')->latest()->get();
    
        return response()->json([
            'pending_todos' => $pending_todos,
            'completed_todos' => $completed_todos,
        ]);
    }    
    // Create a new todo
    function createTodo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $todo = new Todo();
        $todo->title = $request->title;
        $todo->save();

        return response()->json($todo, 201);
    }

    // Update an existing todo
    function updateTodo(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $todo = Todo::findOrFail($id);
        $todo->title = $request->title;
        $todo->save();

        return response()->json($todo, 200);
    }
    // complete a todo
    function completeTodo($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->update([
            'status' => 'completed'
        ]);

        return response()->json(null, 204);
    }
    // Delete a todo
    function deleteTodo($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->delete();

        return response()->json(null, 204);
    }
}
