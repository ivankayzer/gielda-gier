<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BaseOfferRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'game_id'  => 'required',
            'language' => 'required',
            'city_id'  => 'required',
            'platform' => 'required',
        ];
    }

    public function withValidator($validator)
    {
        $validator->sometimes('price', ['bail', 'required', 'regex:/[0-9],?|.?[0-9]/', 'min:1', Rule::notIn(['0', '0.00', '0,00'])], function ($input) {
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
