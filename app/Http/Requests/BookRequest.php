<?php

namespace App\Http\Requests;


use Illuminate\Support\Facades\Route;

class BookRequest extends BaseRequest
{

    public function rules(): array
    {
        $route = request()->route();
        $action = $route->getActionMethod();
        $book_id = $route->book?->id;

        return [
            'banner' => [
                $action === 'store' ? 'required' : 'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:2048',
            ],
            'title' => [
                'required',
                'unique:App\Models\Book,title'.($book_id ? ",$book_id" : ''),
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
