<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use phpseclib3\File\ASN1\Maps\Name;

class RegisterRequest extends FormRequest
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
            'name' => 'required|min:2|max:9',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'password' => 'required|min:6',
            'confirmation_password' => 'required|same:password',
        ];

    }

}
