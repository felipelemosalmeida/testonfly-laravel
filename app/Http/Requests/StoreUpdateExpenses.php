<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateExpenses extends FormRequest
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
            'description' => ['required', 'max:191'],
            'date' => ['date', 'before:tomorrow'],
            'price' => ['required' , 'regex:/(^$|^\d+(,\d{1,2})?$)/', 'not_in:0']
        ];
    }
}
