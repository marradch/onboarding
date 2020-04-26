<?php

namespace App\Http\Controllers\API;

use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;

class MoneyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function transfer(Request $request, User $user)
    {
        $validateData = $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        if (Auth::user()->balance < $validateData['amount']) {
            return response('Not enough money', 406);
        }

        Auth::user()->transfer($user, $validateData['amount']);

        return response('Money successfully send');
    }
}
