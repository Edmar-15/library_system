<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Add authorization logic as needed
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string|max:5000',
            'cover_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rating' => 'nullable|numeric|min:0|max:5',
            'total_copies' => 'required|integer|min:1',
            'available_copies' => 'required|integer|min:0',
            'isbn' => 'nullable|string|unique:books,isbn|max:20',
            'publisher' => 'nullable|string|max:255',
            'publication_year' => 'nullable|integer|min:1000|max:' . date('Y'),
            'category' => 'nullable|string|max:100',
            'language' => 'nullable|string|max:50',
            'pages' => 'nullable|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Book title is required',
            'author.required' => 'Author name is required',
            'total_copies.required' => 'Total copies is required',
            'total_copies.min' => 'There must be at least 1 copy',
            'available_copies.required' => 'Available copies is required',
            'isbn.unique' => 'This ISBN already exists in the system',
            'cover_picture.image' => 'Cover picture must be an image',
            'cover_picture.max' => 'Cover picture must not exceed 2MB',
        ];
    }
}

// UpdateBookRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string|max:5000',
            'cover_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rating' => 'nullable|numeric|min:0|max:5',
            'total_copies' => 'required|integer|min:1',
            'available_copies' => 'required|integer|min:0',
            'isbn' => [
                'nullable',
                'string',
                'max:20',
                Rule::unique('books')->ignore($this->book)
            ],
            'publisher' => 'nullable|string|max:255',
            'publication_year' => 'nullable|integer|min:1000|max:' . date('Y'),
            'category' => 'nullable|string|max:100',
            'language' => 'nullable|string|max:50',
            'pages' => 'nullable|integer|min:1',
        ];
    }
}