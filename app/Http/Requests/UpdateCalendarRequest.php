<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCalendarRequest extends FormRequest
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
            "id"  => [
                'required',
                Rule::exists('calendars', 'id')
                
            ],
            "kickoff"  => [
                'required',
                'date_format:Y-m-d H:i:s'  
            ],
            
        ];
    }
}
