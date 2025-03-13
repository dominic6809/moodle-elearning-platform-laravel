<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmitAssignmentRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->guard('student')->check();
    }

    public function rules()
    {
        return [
            'content' => 'required_without:file|nullable|string',
            'file' => 'required_without:content|nullable|file|max:10240',
        ];
    }
}