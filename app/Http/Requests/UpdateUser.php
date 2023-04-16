<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUser extends FormRequest
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
            'username' => 'min:5|alpha',
            'email' => 'email|min:5',
            'password' => 'min:8',
            'f_name' => 'alpha|min:2',
            'l_name' => 'alpha|min:2',
            'p_number' => 'numeric|min:2',
            'can_withdraw' => 'required|boolean'
        ];
    }
}
