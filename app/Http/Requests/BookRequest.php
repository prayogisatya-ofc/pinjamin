<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
        $routeId = $this->route('book')?->id; // Ambil ID dari route, jika ada

        return [
            'code' => 'required|string|max:255|unique:books,code,' . $routeId . ',id',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:books,slug,' . $routeId . ',id',
            'description' => 'nullable|string',
            "category_id" => "required|array",
            "category_id.*" => "required|exists:categories,id",
            'author' => 'required|string|max:255',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stock' => 'required|integer|min:0',
        ];
    }
}