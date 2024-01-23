<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseRequest;

class RegisterRequest extends BaseRequest
{

    public function rules(): array
    {
        return [
            'name' => [
                'required',
            ],
            'email' => [
                'required',
                'email:rfc,dns',
            ],
            'password' => [
                'required',
                'min:8',
                'confirmed',
            ],
        ];
    }

}
