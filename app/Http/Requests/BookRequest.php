<?php

namespace App\Http\Requests;


use Illuminate\Support\Facades\Route;

class BookRequest extends BaseRequest
{

    public function rules(): array
    {
        return [
            'banner' => [
                Route::getCurrentRoute()->getActionMethod() === 'store' ? 'required' : 'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:2048',
            ],
            'title' => [
                'required',
                'unique:App\Models\Book,title'
            ],
            'description' => [
                'required',
            ],
            'ISBN' => [
                'required',
            ],
            'author_id' => [
                'required',
            ],
            'category_id' => [
                'required',
            ],
        ];
    }

}
