<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Transaction;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function transfer($userTo, $amount)
    {
        if ($this->balance < $amount) {
            return;
        }

        $this->balance -= $amount;
        $this->save();

        $userTo->balance += $amount;
        $userTo->save();

        $transaction = new Transaction();
        $transaction->user_from = $this->id;
        $transaction->user_to = $this->id;
        $transaction->amount = -$amount;
        $transaction->rest = $this->balance;
        $transaction->save();

        $transaction = new Transaction();
        $transaction->user_from = $this->id;
        $transaction->user_to = $userTo->id;
        $transaction->amount = $amount;
        $transaction->rest = $userTo->balance;
        $transaction->save();
    }
}
