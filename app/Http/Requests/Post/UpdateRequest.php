<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // dont' forget to set this as true
        return true;
    }

    public function rules(): array
    {
        // make all of the fields required, set featured image to accept only images
        return [
            'title' => 'required|string|min:3|max:250',
            'content' => 'required|string|min:3|max:10000',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png',
            'category' => 'nullable|in:media,csr',
            'year' =>'required|integer|min:1900|max:' . date('Y'),
        ];
    }
}
