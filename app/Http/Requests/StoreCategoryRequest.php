<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        
        return auth()->user()->role === 'admin'; 
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $categoryId = $this->route('category') ? $this->route('category')->id : null;

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:categories,name,' . $categoryId,
                // Regex ini hanya membolehkan Huruf (a-z, A-Z) dan Spasi
                'regex:/^[a-zA-Z\s]+$/' 
            ],
        ];
    }
    //pesan error
    public function messages(): array
    {
        return [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique' => 'Nama kategori ini sudah ada.',
            'name.regex' => 'Nama kategori hanya boleh berisi huruf dan spasi (tidak boleh angka).',
        ];
    }
}
