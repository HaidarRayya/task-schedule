<?php

namespace App\Http\Requests\Task;

use App\Rules\TaskPriority;
use App\Rules\TaskStatus;
use App\Rules\TaskType;
use App\Services\TaskRequestService;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class FillterTaskRequest extends FormRequest
{
    protected $taskRequestService;
    public function __construct(TaskRequestService $taskRequestService)
    {
        $this->taskRequestService = $taskRequestService;
    }
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status' => ['sometimes', new TaskStatus],
            'due_date' => ['sometimes', 'date_format:Y-m-d'],
            'sort' => ['sometimes', 'in:ASC,DESC'],
            'title' => ['sometimes', 'string'],
        ];
    }

    public function attributes(): array
    {
        return  $this->taskRequestService->attributes();
    }
    public function failedValidation(Validator $validator)
    {
        $this->taskRequestService->failedValidation($validator);
    }
    public function messages(): array
    {
        return $this->taskRequestService->messages();
    }
}