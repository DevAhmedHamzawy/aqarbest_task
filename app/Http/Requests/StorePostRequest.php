<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'main_image' => 'mimes:jpeg,jpg,png,gif|sometimes|max:10000', // max 10000kb
            'category_id' => 'required|numeric',
            'user_id' => 'required|numeric',
            'title' => 'required',
            'body' => 'required',
        ];
    }
}
