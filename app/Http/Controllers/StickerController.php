<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sticker;
use App\Sticker_State;
use App\Transaction;

class StickerController extends Controller
{
    public function check(Request $request)
    {
        $sstate = Sticker_State::where('event_id', $request->event_id)->with('sticker')->get();
        return ['sticker_state' => $sstate];
    }

    public function stickerUpdate(Request $request)
    {
        $sticker_state = Sticker_State::where([
            'event_id' => $request->event_id,
            'sticker_id' => $request->sticker_id,
        ])->first();

        $sticker_state->update([
            'quantity' => $sticker_state->quantity + $request->quantity,
        ]);

        $transaction = Transaction::create([
            'transaction_type' => 'purchased_sticker',
            'transaction_value' => '-' . Sticker::where('id', $request->sticker_id)->first()->sticker_cost * $request->quantity,
            'user_id' => auth()->id(),
        ]);

        auth()->user()->update([
            'coins' => auth()->user()->coins + $transaction->transaction_value,
        ]);
    }
}
