<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @group Task management
 *
 * APIs for managing tasks
 * @authenticated
 */
class TaskController extends Controller
{
    private int $perPage = 2;

    /**
     * Display a listing of the tasks.
     *
     * @queryParam filters[is_completed] integer Filter by status (completed or not completed). Example: 0
     * @queryParam filters[user_id] integer Filter by creator No-example
     */
    public function index(): AnonymousResourceCollection
    {
        return TaskResource::collection(Task::query()->filter()->paginate($this->perPage));
    }

    /**
     * Store a newly created task in storage.
     *
     * @bodyParam name string required Must not be greater than 100 characters. No-example
     * @bodyParam description string required Must not be greater than 255 characters. No-example
     */
    public function store(StoreTaskRequest $request): JsonResponse
    {
        $task = Task::query()->create([...$request->validated(), 'user_id' => auth()->id()]);

        return response()->json([
            'message' => 'Task created successfully.',
            'data' => new TaskResource($task),
        ]);
    }

    /**
     * Update the task in storage.
     *
     * @urlParam id string required The ID of the task to update No-example
     * @bodyParam name string Must not be greater than 100 characters. No-example
     * @bodyParam description string Must not be greater than 255 characters. No-example
     */
    public function update(UpdateTaskRequest $request, string $id): JsonResponse
    {
        $task = Task::query()->find($id);
        if (!$task) {
            return response()->json(['error' => 'Task not found.'], 404);
        }

        $task->update($request->validated());

        return response()->json([
            'message' => 'Task updated successfully.',
            'data' => new TaskResource($task),
        ]);
    }

    /**
     * Remove the task from storage.
     *
     * @urlParam id string required The ID of the task to delete No-example
     */
    public function destroy(string $id): JsonResponse
    {
        $task = Task::query()->find($id);
        if (!$task) {
            return response()->json(['error' => 'Task not found.'], 404);
        }

        $task->delete();

        return response()->json(['message' => 'Task deleted successfully.']);
    }
}
