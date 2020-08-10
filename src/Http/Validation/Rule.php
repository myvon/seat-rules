<?php


namespace Lvlo\Rules\Http\Validation;


use Illuminate\Foundation\Http\FormRequest;

class Rule extends FormRequest
{
    public function authorize()
    {

        return true;
    }


    public function rules()
    {
        return [
            'object'  => 'required',
            'content' => 'required',
            'language' => 'required',
        ];
    }
}