<?php

declare(strict_types=1);

namespace App\Http\Requests\BannedWord;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWordRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'word' => 'required|unique:banned_words|max:255'
        ];
    }
}
