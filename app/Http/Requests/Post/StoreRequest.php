<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|min:3|max:250',
            'content' => 'required|string|min:3|max:10000',
            'featured_image' => 'required|image|mimes:jpg,jpeg,png',
            'category' => 'required|in:media,csr',
            'year' =>'required|integer|min:1900|max:' . date('Y'),
        ];
    }
}
