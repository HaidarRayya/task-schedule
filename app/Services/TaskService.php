<?php

namespace App\Services;

use App\Enums\TaskStatus;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class TaskService
{
    /**
     * get all  tasks
     * @param string $status 
     * @param string $title
     * @param  $due_date
     * @param string $sort
     * @return array contain the status of opertion  and the task 
     */
    public function allTasks($title, $status, $due_date, $sort)
    {
        try {

            $tasks = Task::myTask(Auth::user()->id)
                ->byTitle($title)
                ->byStatus($status)
                ->byDueDate($due_date)
                ->sortDueDate($sort)
                ->paginate(6);

            $tasks = TaskResource::collection($tasks);
            return [
                'status' => 'success',
                'data' => [
                    'tasks' => $tasks
                ]
            ];
        } catch (Exception $e) {
            Log::error("error in get all tasks" . $e->getMessage());
            return  [
                'status' => 'error',
                'data' => [
                    'code' => 500,
                    'message' => "error in get all tasks" . $e->getMessage()
                ]
            ];
        }
    }
    /**
     * create  a  new task
     * @param array $data 
     * @return array contain the status of opertion  and the task 
     */
    public function createTask(array $data)
    {
        try {
            $task = Task::create([
                'title' => $data['title'],
                'description' => $data['description'],
                'due_date' => $data['due_date'],
                'user_id' => Auth::user()->id
            ]);

            $task = TaskResource::make($task);
            return [
                'status' => 'success',
                'data' => [
                    'task' => $task
                ]
            ];
        } catch (Exception $e) {
            Log::error("error in create task" . $e->getMessage());
            return  [
                'status' => 'error',
                'data' => [
                    'code' => 500,
                    'message' => "error in create task" . $e->getMessage()
                ]
            ];
        }
    }

    /**
     * show  a  task
     * @param int $task_id
     * @return array contain the status of opertion  and the task 
     */
    public function oneTask($task_id)
    {
        try {
            $task =  Cache::remember('task_' . $task_id, 600, function () use ($task_id) {
                return Task::findOrFail($task_id);
            });
            $task = TaskResource::make($task);
            return [
                'status' => 'success',
                'data' => [
                    'task' => $task
                ]
            ];
        } catch (Exception $e) {
            Log::error("error in get a task" . $e->getMessage());
            return  [
                'status' => 'error',
                'data' => [
                    'code' => 500,
                    'message' => "error in get task" . $e->getMessage()
                ]
            ];
        } catch (ModelNotFoundException $e) {
            Log::error("error in get a task" . $e->getMessage());
            return  [
                'status' => 'error',
                'data' => [
                    'code' => 404,
                    'message' => "error in get task" . $e->getMessage()
                ]
            ];
        }
    }
    /**
     * update  a  task
     * @param array $data 
     * @param int $task_id
     * @return array contain the status of opertion  and the task 
     */
    public function updateTask($data, $task_id)
    {

        try {
            Cache::forget('task_' . $task_id);
            $task = Task::findOrFail($task_id);
            $task->update($data);
            $task =  Cache::remember('task_' . $task_id, 600, function () use ($task_id) {
                return Task::findOrFail($task_id);
            });
            $task = TaskResource::make($task);
            return [
                'status' => 'success',
                'data' => [
                    'task' => $task
                ]
            ];
        } catch (Exception $e) {
            Log::error("error in update a task" . $e->getMessage());
            return  [
                'status' => 'error',
                'data' => [
                    'code' => 500,
                    'message' => "error in update task" . $e->getMessage()
                ]
            ];
        } catch (ModelNotFoundException $e) {
            Log::error("error in update a task" . $e->getMessage());
            return  [
                'status' => 'error',
                'data' => [
                    'code' => 404,
                    'message' => "error in update task" . $e->getMessage()
                ]
            ];
        }
    }

    /**
     * delete  a task
     * @param int $task_id
     * @return array contain the status of opertion  
     */
    public function deleteTask($task_id)
    {
        try {
            $task = Task::findOrFail($task_id);
            $task->delete();
            Cache::forget('task_' . $task_id);
            return [
                'status' => 'success',
            ];
        } catch (Exception $e) {
            Log::error("error in  delete a task"  . $e->getMessage());
            return  [
                'status' => 'error',
                'data' => [
                    'code' => 500,
                    'message' => "error in delete task" . $e->getMessage()
                ]
            ];
        } catch (ModelNotFoundException $e) {
            Log::error("error in  delete a task"  . $e->getMessage());
            return  [
                'status' => 'error',
                'data' => [
                    'code' => 404,
                    'message' => "error in delete task" . $e->getMessage()
                ]
            ];
        }
    }


    /**
     * start a task
     * @param int $task_id  
     * @return array contain the status of opertion     
     */
    public function startTask($task_id)
    {

        try {
            Cache::forget('task_' . $task_id);
            $task = Task::findOrFail($task_id);

            $task->status = TaskStatus::IN_PROGRESS->value;
            $task->save();
            Cache::put('task_' . $task_id, $task, 600);
            return [
                'status' => 'success',
            ];
        } catch (Exception $e) {
            Log::error("error in  start a task"  . $e->getMessage());
            return  [
                'status' => 'error',
                'data' => [
                    'code' => 500,
                    'message' => "error in start task" . $e->getMessage()
                ]
            ];
        } catch (ModelNotFoundException $e) {
            Log::error("error in  start a task"  . $e->getMessage());
            return  [
                'status' => 'error',
                'data' => [
                    'code' => 404,
                    'message' => "error in start task" . $e->getMessage()
                ]
            ];
        }
    }
    /**
     * end a task
     * @param int $task_id   
     * @return array contain the status of opertion    
     */
    public function endTask($task_id)
    {
        try {

            Cache::forget('task_' . $task_id);
            $task = Task::findOrFail($task_id);
            $task->status = TaskStatus::COMPLETED->value;
            $task->save();
            Cache::put('task_' . $task_id, $task, 600);

            return [
                'status' => 'success',
            ];
        } catch (Exception $e) {
            Log::error("error in  end a task"  . $e->getMessage());
            return  [
                'status' => 'error',
                'data' => [
                    'code' => 500,
                    'message' => "error in end task" . $e->getMessage()
                ]
            ];
        } catch (ModelNotFoundException $e) {
            Log::error("error in  end a task"  . $e->getMessage());
            return  [
                'status' => 'error',
                'data' => [
                    'code' => 404,
                    'message' => "error in end task" . $e->getMessage()
                ]
            ];
        }
    }
}
