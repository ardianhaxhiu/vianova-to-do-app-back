<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Repositories\TaskRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    protected $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function all($status)
    {
        return $this->taskRepository->allWithStatus($status);
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'level' => ['required', 'integer', 'min:1', 'max:3'],
        ]);

        $task = $this->taskRepository->create(array_merge($data, ['status' => 1]));

        return response()->json(['success' => true, 'message' => 'Task created', 'data' => $task], 200);
    }

    public function update(Request $request, $id)
    {
        $task = $this->taskRepository->findById($id);

        if ($task) {
            $data = $this->validate($request, [
                'name' => ['required', 'string', 'max:255'],
                'level' => ['required', 'integer', 'min:1', 'max:3'],
            ]);

            $task->name = $data['name'];
            $task->level = $data['level'];
            $task->updated_at = Carbon::now();

            //$task->update(array_merge($data, ['updated_at' => Carbon::now()]));
            $task->save();

            return response()->json([
                'success' => true,
                'message' => 'Task updated successfully!',
                'data' => $task
            ], 200);
        }

        return response()->json(['success' => false, 'message' => 'Task not found!'], 404);
    }

    public function delete($id)
    {
        $task = $this->taskRepository->findById($id);

        if ($task) {
            $task->delete();

            return response()->json(['success' => true, 'message' => 'Task removed successfully!', 'data' => $task], 200);
        }

        return response()->json(['success' => false, 'message' => 'Task not found!'], 404);
    }

    public function changeStatus(Request $request, $id)
    {
        $task = $this->taskRepository->findById($id);

        if ($task) {
            $data = $this->validate($request, [
                'status' => ['required', 'integer', 'min:1', 'max:3`']
            ]);


            $task->status = $data['status'];
            $task->updated_at = Carbon::now();
            $task->save();

            return response()->json(['success' => true, 'message' => 'Task status changed successfully!',
                'task' => $task], 200);
        }

        return response()->json(['success' => false, 'message' => 'Task not found!'], 404);
    }

    public function search($term)
    {
        return response()->json(['success' => true, 'data' => $this->taskRepository->search($term)]);  
    }

}
