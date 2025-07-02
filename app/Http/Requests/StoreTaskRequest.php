<?php

namespace App\Http\Requests;

use App\Enums\TaskStatusEnum;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
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
        // * If HTTP VERB is PATCH:
        if(request()->isMethod('patch'))
        {
            return [
                'task_list_id' => 'sometimes|exists:task_lists,id',
                'description' => 'required|string|max:355',
                'image' => 'nullable|string|max:355',
                'status' => 'required|in:' . implode(',', TaskStatusEnum::casesValues()),
            ];
        }

        // * If HTTP VERB is POST:
        return [
            'task_list_id' => 'required|exists:task_lists,id',
            'description' => 'required|string|max:355',
            'image' => 'nullable|string|max:355',
            'status' => 'required|in:' . implode(',', TaskStatusEnum::casesValues()),
        ];
    }

}
