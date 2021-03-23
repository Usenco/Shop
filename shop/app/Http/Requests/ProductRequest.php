<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $rules = [
            'title' => 'required|string',
            'arrived_time' => 'required|date|date_format:Y-m-d',
            'mainimg' => 'required|string',
            'price' => 'required|min:0',
            'idCategory' =>'required|integer|min:0',
        ];
        switch ($this->getMethod())
        {
            case 'POST':
              return $rules;
            case 'PUT':
              return $rules;
            case 'DELETE':
              return $rules;
        }
    }
}
