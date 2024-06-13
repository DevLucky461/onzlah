<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use Carbon\Carbon;

class CoinController extends Controller
{
    public function viewCoins()
    {
        $transaction = Transaction::where('user_id', auth()->id())->get();

        return view('/coins', compact('transaction'));
    }

    public function getTransaction(Request $request)
    {
        $transaction = Transaction::where('id', $request->transaction_id)->with('events', 'rewards')->first();
        $type = null;
        $item = null;

        switch ($transaction->transaction_type) {
            case ('redeemed_reward'):
                $item = 'reward(s)';
                break;
            case ('purchased_sticker'):
                $item = 'sticker(s)';
                break;
            case ('won_prize'):
                $item = 'coins';
                break;
        }

        if ($transaction->transaction_value > 0) {
            $type = 'won';
            return ['message' => auth()->user()->name . ' has ' . $type . ' ' . $item . ' ' . $transaction->transaction_value . ' coins from ' . $transaction->events->event_name . ' at ' . Carbon::parse($transaction->created_at)->format('d/M/Y') . ' !'];
        } else {
            $type = 'bought';
            return ['message' => auth()->user()->name . ' has ' . $type . ' ' . $item . ' at ' . $transaction->transaction_value . ' coins at ' . Carbon::parse($transaction->created_at)->format('d/M/Y') . ' !'];
        }
    }
}
