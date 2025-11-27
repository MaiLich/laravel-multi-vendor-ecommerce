<?php

namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;

class StoreBlogPostRequest extends FormRequest {
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'title' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
        ];
    }
}
