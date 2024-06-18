<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreBookmarkRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return (bool) Auth::user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'min:5', 'max:100', 'string'],
            'url' => ['required', 'min:10', 'max:500', 'string'],
            'mainCategory' => ['string', 'min:3', 'max:50'],
            'newCategories' => ['nullable','array'],
            'newCategories.*' => ['string', 'max:50'],
        ];
    }
}
