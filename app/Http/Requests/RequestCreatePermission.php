<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RequestCreatePermission extends FormRequest
{

    public function authorize(): bool
    {
        return false;
    }


    public function rules($permission = null): array
    {
        return [
            'name'=>['required','min:4', Rule::unique('permissions','name')->ignore($permission)]
        ];
    }
}
