<?php

namespace App\Http\Requests;

use App\Enums\Location;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Support\Facades\Auth;

class UpdateScorerRequest extends FormRequest
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
            "goal"  => [
                'required',
                'integer'
            ],
            "location"  => [
                'required',
                new Enum(Location::class),
            ],
            
        ];
    }
}
