<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\FillterTaskRequest;
use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Services\PolicyService;
use App\Services\TaskService;
use Illuminate\Contracts\View\View;

class TaskController extends Controller
{
    protected $taskService;
    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }
    /**
     * Display a listing of the resource.
     */
    /**
     * get all  tasks
     * @param FillterTaskRequest $request
     * @return View index or error page
     */
    public function index(FillterTaskRequest $request)
    {
        $title = $request->input('title');
        $status = $request->input('status');
        $due_date = $request->input('due_date');
        $sort = $request->input('sort');

        $data = $this->taskService->allTasks($title, $status, $due_date, $sort);
        if ($data['status'] == 'error') {
            return view('error', [
                'message' => $data['data']['message'],
                'code' => $data['data']['code']

            ]);
        }
        return view('tasks.index', [
            'tasks' => $data['data']['tasks']
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    /**
     * show create task page  
     * @return View create page
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     *  create new task   
     * @param StoreTaskRequest $request
     * return View create page or redirect to previous page  
     */
    public function store(StoreTaskRequest $request)
    {
        $taskData = $request->validated();
        $data = $this->taskService->createTask($taskData);
        if ($data['status'] == 'error') {
            return view('error', [
                'message' => $data['data']['message'],
                'code' => $data['data']['code']

            ]);
        }

        return redirect()->back()->with('message', 'تمت اضافة المهمة بنجاح');
    }

    /**
     * Display the specified resource.
     */
    /**
     *  show a  task   
     * @param int $task_id
     * return View create page or redirect to previous page  
     */
    public function show(int $task_id)
    {
        if (!PolicyService::checkPolicy($task_id)) {
            abort(403);
        }
        $data = $this->taskService->oneTask($task_id);
        if ($data['status'] == 'error') {
            return view('error', [
                'message' => $data['data']['message'],
                'code' => $data['data']['code']

            ]);
        }
        return view('tasks.show', [
            'task' => $data['data']['task']
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    /**
     *  get update  task page
     * @param int $task_id
     * return View create page  
     */
    public function edit($task_id)
    {
        if (!PolicyService::checkPolicy($task_id)) {
            abort(403);
        }
        $data = $this->taskService->oneTask($task_id);
        if ($data['status'] == 'error') {
            return view('error', [
                'message' => $data['data']['message'],
                'code' => $data['data']['code']

            ]);
        }
        return view('tasks.edit', [
            'task' => $data['data']['task']
        ]);
    }

    /**
     * Update the specified resource in storage.
     */

    /**
     *  update a  task  
     *  @param UpdateTaskRequest $request
     * @param int $task_id
     * return View create page or redirect to previous page  
     */
    public function update(UpdateTaskRequest $request,  $task_id)
    {
        if (!PolicyService::checkPolicy($task_id)) {
            abort(403);
        }
        $taskData = $request->validated();
        $data = $this->taskService->updateTask($taskData, $task_id);
        if ($data['status'] == 'error') {
            return view('error', [
                'message' => $data['data']['message'],
                'code' => $data['data']['code']

            ]);
        }
        return redirect()->back()->with('message', 'تمت تعديل المهمة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    /**
     *  delete a  task  
     * @param int $task_id
     * return View create page or redirect to previous page  
     */
    public function destroy(int $task_id)
    {
        if (!PolicyService::checkPolicy($task_id)) {
            abort(403);
        }
        $data =  $this->taskService->deleteTask($task_id);
        if ($data['status'] == 'error') {
            return view('error', [
                'message' => $data['data']['message'],
                'code' => $data['data']['code']

            ]);
        }
        return redirect(route('tasks.index'))->with('message', 'تمت حذف المهمة بنجاح');
    }
    /**
     *  start a  task  
     * @param int $task_id
     * return View create page or redirect to previous page  
     */
    public function start(int $task_id)
    {
        if (!PolicyService::checkPolicy($task_id)) {
            abort(403);
        }
        $data =  $this->taskService->startTask($task_id);
        if ($data['status'] == 'error') {
            return view('error', [
                'message' => $data['data']['message'],
                'code' => $data['data']['code']

            ]);
        }
        return redirect()->back()->with('message', 'تم بدء المهمة بنجاح');
    }
    /**
     *  end a  task  
     * @param int $task_id
     * return View create page or redirect to previous page  
     */

    public function end($task_id)
    {
        if (!PolicyService::checkPolicy($task_id)) {
            abort(403);
        }
        $data =  $this->taskService->endTask($task_id);
        if ($data['status'] == 'error') {
            return view('error', [
                'message' => $data['data']['message'],
                'code' => $data['data']['code']

            ]);
        }
        return redirect()->back()->with('message', 'تم انهاء المهمة بنجاح');
    }
}
