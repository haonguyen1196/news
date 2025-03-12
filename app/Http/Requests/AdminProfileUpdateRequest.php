<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AdminProfileUpdateRequest extends FormRequest
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
        return [
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:3000'],
            'name' => ['required', 'string', 'max:255'],
            //email mới phải là duy nhất, ngoại trừ email hiện tại của người dùng được phép thay đổi
            'email' => ['required', 'string', 'max:255', 'unique:admins,email,' . Auth::guard('admin')->user()->id],
        ];
    }
}