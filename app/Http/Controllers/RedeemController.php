<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reward;
use App\User;
use App\Claim;
use App\Transaction;
use Illuminate\Support\Str;

class RedeemController extends Controller
{
    public function view()
    {
        $reward = \App\Reward::with('reward_count')->get();
        return view('reward-2', compact('reward'));
    }

    public function viewDetails($reward_id)
    {
        $r = \App\Reward::where('id', $reward_id)->with('reward_count')->first();
        return view('reward-2-details', compact('r'));
    }

    public function viewVoucher($id)
    {
        $reward = Reward::with('claim')->get();
        $reward = $reward->filter(function ($value) use ($id) {
            return $value->claim->contains(function ($klem) use ($id) {
                return $klem->user_id == $id;
            });
        });

        //dd($reward[0]->claim->where('user_id', $id));
        /* dd($reward->last()->claim->filter(function($r) use ($id){
            return $r->user_id == $id;
        })); // dont delete cuz this formula is important*/

        return view('my-redeem', compact('reward', 'id'));
    }


    public function viewRedeemDetails($redeem_id, $claim_id)
    {
        $r = \App\Reward::where('id', $redeem_id)->with('reward_count')->first();
        $c = \App\Claim::where('id', $claim_id)->first();
        //dd($c);
        return view('my-redeem-details', compact('r', 'c'));
    }

    public function addVoucher(Request $request)
    {
        $reward = Reward::where([
            'id' => $request->reward_id,
        ])->with('claim')->first();

        $claim_slot = $reward->claim->filter(function ($c) {
            return (($c->unlist_date > now() || $c->unlist_date == null) && $c->user_id == null);
        });
        //dd($claim_slot->isNotEmpty());
        $user = User::where('id', auth()->id())->first();

        if ($claim_slot->isNotEmpty() && $user->coins >= $reward->cost_in_coins) {

            $claim_slot->first()->update([
                'user_id' => $user->id,
            ]);

            $user->update([
                'coins' => ($user->coins - $reward->cost_in_coins),
            ]);

            Transaction::create([
                'transaction_type' => 'redeemed_reward',
                'transaction_value' => '-' . $reward->cost_in_coins,
                'user_id' => $request->user_id,
                'reward_id' => $request->reward_id,
            ]);

            return ['success' => 'true', 'message' => 'Reward redeemed !!'];
        } else return ['success' => 'false', 'message' => 'either you are poor or you are a hacker >:p'];
    }

    public function rewardFilterButton(Request $request)
    {
        if ($request->reward_type != 'all') {
            $reward = \App\Reward::where('reward_type', $request->reward_type)->with('claim')->get();
        } else {
            $reward = \App\Reward::with('claim')->get();
        }

        return ['reward' => $reward];
    }

    public function rewardFilterInput(Request $request)
    {
        $reward = \App\Reward::where('reward_name', 'LIKE', '%' . $request->reward_name . '%')->with('claim')->get();
        return ['status' => 'available', 'reward' => $reward];
    }

    public function useReward(Request $request)
    {
        $claim = \App\Claim::where('id', $request->claim_id)->first();
        if ($claim->status == 'valid') $claim->update(['status' => 'used']);
        return ['code' => $claim->reward_code];
    }
}
