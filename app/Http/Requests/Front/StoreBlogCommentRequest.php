<?php

namespace App\Http\Requests\Front;
use Illuminate\Foundation\Http\FormRequest;

class StoreBlogCommentRequest extends FormRequest {
    public function authorize(): bool { return auth()->check(); }
    public function rules(): array {
        return ['content' => 'required|string|min:3|max:2000'];
    }
}
