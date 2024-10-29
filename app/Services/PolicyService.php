<?php

namespace App\Services;

use App\Models\Task;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PolicyService
{
    /**
     *  check if aurh user owns this  task  
     * @param int $task_id
     * @return bool|array contain the status of opertion 
     */
    public static function checkPolicy($task_id)
    {
        try {
            $task = Task::findOrFail($task_id);
            if ($task->user_id != Auth::user()->id) {
                return false;
            }
            return true;
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
}
