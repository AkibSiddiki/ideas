<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IdeaRequest extends FormRequest
{
    public function authorize()
    {
        return true; // or false if you want to restrict this request to certain users
    }
    public function rules()
    {
        return [
            'idea' => 'required|min:2|max:240',
        ];
    }
}