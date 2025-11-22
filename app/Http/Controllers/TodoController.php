<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Traits\CommonTrait;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    use CommonTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $todos = auth()->user()->todos()->get();
            return $this->sendResponse([
                'data' => $todos,
                'message' => 'Todos retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return $this->sendError(['message' => $e->getMessage()], 500);
        }   
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        try {
            $todo = Todo::create([
                'title' => $request->title,
                'description' => $request->description,
                'user_id' => auth()->id(),
            ]);
            return $this->sendResponse([
                'data' => $todo,
                'message' => 'Todo created successfully'
            ], 201);
        } catch (\Exception $e) {
            return $this->sendError(['message' => $e->getMessage()], 500);
        }   
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        try {
            return $this->sendResponse([
                'data' => $todo,
                'message' => 'Todo retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return $this->sendError(['message' => $e->getMessage()], 500);
        }   
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
       // 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        try {
            $todo->update($request->all());
            return $this->sendResponse([
                'data' => $todo,
                'message' => 'Todo updated successfully'
            ]);
        } catch (\Exception $e) {
            return $this->sendError(['message' => $e->getMessage()], 500);
        }   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        try {
            $todo->delete();
            return $this->sendResponse([
                'data' => $todo,
                'message' => 'Todo deleted successfully'
            ]);
        } catch (\Exception $e) {
            return $this->sendError(['message' => $e->getMessage()], 500);
        }   
    }
}
