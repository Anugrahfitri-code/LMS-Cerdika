<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreContentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $course = $this->route('course');
        return $this->user()->can('create', [Content::class, $course]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $courseId = $this->route('course')->id;

        return [
            'title' => [
                'required', 
                'string', 
                'max:255',
                Rule::unique('contents')->where('course_id', $courseId)
            ],
            'body' => ['required', 'string'],
            'order' => [
                'nullable', 
                'integer', 
                'min:0',
                Rule::unique('contents')->where('course_id', $courseId)
            ],
        ];
    }
}    
