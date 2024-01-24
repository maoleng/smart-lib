<?php

namespace App\Http\Requests;


use Illuminate\Support\Facades\Route;

class BookInstanceRequest extends BaseRequest
{

    public function rules(): array
    {
        return [
            'code' => [
                'required',
            ],
            'book_id' => [
                'required',
                'exists:App\Models\Book,id',
            ],
        ];
    }

}
