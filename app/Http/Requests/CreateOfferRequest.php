<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateOfferRequest extends FormRequest
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
            'game_id' => 'required',
            'language' => 'required',
            'city_id' => 'required',
            'platform' => 'required',
            'price' => 'required',
        ];
    }

    public function withValidator($validator)
    {
        $validator->sometimes('price', 'gt:0', function($input) {
            return $input->sellable;
        });

        $validator->sometimes('sellable', Rule::in([true]), function ($input) {
            return !$input->tradeable && $input->is_published;
        });

        $validator->sometimes('tradeable', Rule::in([true]), function ($input) {
            return !$input->sellable && $input->is_published;
        });
    }
}
