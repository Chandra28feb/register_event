<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterEventStoreRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'total_selected_item_input'=>'required',
            'total_amount_input'      =>'required'
        ];
    }
    public function messages(){
        return[
            'total_selected_item_input.required' =>'Total item should not be empty. Please add atleast one item',
            'total_amount_input.required'       =>'Total amount should not be empty.Please add atleast one item',
        ];  
    }
}
