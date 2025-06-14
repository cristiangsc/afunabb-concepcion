<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RequestCreateBenefit extends FormRequest
{
    public function authorize(): bool
    {
        return false;
    }

    public function rules($benefit = null): array
    {
        return [
            'name'=>['required','min:4', Rule::unique('benefits','name')->ignore($benefit)],
            'fecha' => 'required|date',
            'vigencia' => 'nullable'
        ];
    }
}
