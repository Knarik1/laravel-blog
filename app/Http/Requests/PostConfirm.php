<?php

namespace App\Http\Requests;


class PostConfirm extends Request
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
            'heading' => 'required',
            'text' => 'required',
            'category' =>'required',
            'tag' =>'required',
            'image' => 'image'
        ];
    }
}
