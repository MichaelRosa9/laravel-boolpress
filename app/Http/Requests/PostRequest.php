<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; /* put true instead of default that is false */
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:20',
            'content' => 'required|min:3',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id'
        ];
    }
    /* this fucntion customizes the error messages */
    public function messages(){

        return [
            'title.required' => 'The title must required',
            'title.max' => 'You can write up to :max characters',
            'title.min' => 'You can not write less than :min characters',
            'content.required' => 'The content must required',
            'category_id.exists' => 'The chosen category doesn\'t exist',
            'tags' => 'The chosen tag doen\'t exist'
        ];
    }
}
