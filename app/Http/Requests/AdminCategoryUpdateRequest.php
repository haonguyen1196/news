<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminCategoryUpdateRequest extends FormRequest
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

        $categoryId = $this->route('category');
        return [
            'name' => ['required','max:255', 'unique:categories,name,'.$categoryId],
            'lang' => ['required'],
            'show_at_nav' => ['required','boolean'],
            'status' => ['required','boolean'],
        ];
    }
}