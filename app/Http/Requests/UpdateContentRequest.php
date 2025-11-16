<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateContentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $content = $this->route('content');
        return $this->user()->can('update', $content);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $content = $this->route('content');
        $courseId = $content->course_id;
        $contentId = $content->id;

        return [
            'title' => [
                'required', 
                'string', 
                'max:255',
                Rule::unique('contents')
                    ->where('course_id', $courseId)
                    ->ignore($contentId) 
            ],
            'body' => ['required', 'string'],
            'order' => [
                'nullable', 
                'integer', 
                'min:0',
                Rule::unique('contents')
                    ->where('course_id', $courseId)
                    ->ignore($contentId)
            ],
        ];
    }
}
