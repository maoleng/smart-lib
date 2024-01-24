<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $query = User::query();

        if ($search = $request->get('q')) {
            $query->where(function ($q) use ($search) {
                $q->orWhere('email', 'LIKE', "%$search%")->orWhere('name', 'LIKE', "%$search%");
            });
        }

        $query->withCount(['borrows' => function ($q) {
            $q->whereNotNull('borrow_at')->whereNull('actual_return_at');
        }]);

        return view('app.user.index', [
            'users' => $query->paginate(7)->withQueryString(),
        ]);
    }
}
