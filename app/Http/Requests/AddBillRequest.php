<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddBillRequest extends FormRequest
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
            'title' => 'required|string',
            'description' => 'required',
            'author_id' => 'required',
        ];
    }
    
       public function messages() {
        return [
            'title.required' => 'Name field is required.',
            'description.required' => 'Description field is required.',
            'author_id.required' => 'Description field is required.',
        ];
    }
}
