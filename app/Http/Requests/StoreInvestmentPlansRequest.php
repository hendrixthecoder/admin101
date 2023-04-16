<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvestmentPlansRequest extends FormRequest
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
            'plan_name' => 'required|alpha',
            'amount' => 'required|numeric',
            'min_deposit' => 'required|numeric',
            'max_deposit' => 'required|numeric',
            'min_return' => 'required|numeric',
            'max_return' => 'required|numeric',
            'gift_bonus' => 'required|numeric',
            'duration' => 'required',
            'top_up_value' => 'required',
            'top_up_type' => 'required',
            'top_up_interval' => 'required',
        ];
    }
}
