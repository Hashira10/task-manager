<?php
namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Получить список всех задач
    public function index(){
        return Task::all();
    }
    // Создать новую задачу
    public function store(Request $request){
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);

        $task = Task::create($validated);

        return response()->json($task, 201);
    }
    // Обновить задачу по id
    public function update(Request $request, $id){
        $task = Task::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);

        $task->update($validated);
        return response()->json($task);
    }
    // Удалить задачу по id
    public function destroy($id){
        $task = Task::findOrFail($id);
        $task->delete();
        return response()->json(null, 204);
    }
}
