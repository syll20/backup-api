<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UpdateStandingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "ranking"    => [
                'required',
                'array', // input must be an array
                'min:12'  // there must be n members in the array
            ],
            "ranking.*.id"  => [
                'required',
                'integer',
                Rule::exists('standings', 'id')
            ],
            /*"ranking.*.league"  => [
                'required',
                'integer',
            ],
            "ranking.*.season"  => [
                'required',
                'integer',
            ],*/
            "ranking.*.club_id"  => [
                'required',
                'integer',
            ],
            "ranking.*.rank"  => [
                'required',
                'integer',
                'between:1,20'
            ],
            "ranking.*.points"  => [
                'required',
                'integer',
                'between:0,114'
            ],
            "ranking.*.played"  => [
                'required',
                'integer',
                'between:0,38'    
            ],
            "ranking.*.win"  => [
                'required',
                'integer',
                'between:0,38'       
            ],
            "ranking.*.draw"  => [
                'required',
                'integer',
                'between:0,38'       
            ],
            "ranking.*.lose"  => [
                'required',
                'integer',
                'between:0,38'       
            ],
            "ranking.*.goals_for"  => [
                'required',
                'integer',
                'between:0,150'       
            ],
            "ranking.*.goals_against"  => [
                'required',
                'integer',
                'between:0,150'
            ],
            "ranking.*.goals_diff"  => [
                'required',
                'integer',
                'between:-150,150'       
            ],
            "ranking.*.last5"  => [
                'required',
                'string',
                'between:0,5'
            ],

        ];
    }



    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'ranking.*.win.between' => '# win must be between 0 and 38, for :position',
            'ranking.*.club_id.required' => 'Le club est requis',
        ];
    }


}
