<?php

namespace App\Http\Requests;

use App\Offer;
use App\ValueObjects\Platform;
use App\ValueObjects\TransactionType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $offer = Offer::active()->findOrFail(request()->get('offer_id'));
        return (int)$offer->seller_id !== auth()->user()->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'required',
            'offer_id' => 'required'
        ];
    }

    public function withValidator($validator)
    {
        $validator->sometimes('game_id', ['bail', 'required', 'exists:games,igdb_id'], function ($input) {
            return $input->type === TransactionType::TRADE && !$input->money;
        });

        $validator->sometimes('platform', [
            'bail',
            'required',
            Rule::in(array_keys(Platform::availablePlatforms()))
        ], function ($input) {
            return $input->type === TransactionType::TRADE && !$input->money;
        });

        $validator->sometimes('money', ['bail', 'sometimes', 'regex:/[0-9],?|.?[0-9]/', 'min:1', Rule::notIn(['0', '0.00', '0,00'])], function ($input) {
            return $input->type === TransactionType::TRADE && strlen($input->money);
        });
    }
}
