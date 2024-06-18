<?php

namespace App\Http\Requests;

use App\Models\Bookmark;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateBookmarkRequest extends FormRequest
{

    public function authorize(): bool
    {
        $bookmark = $this->route('bookmark');
        return Gate::allows('edit-bookmark', $bookmark);
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
            'url' => ['required', 'min:10', 'max:500', 'string']
        ];
    }
}
