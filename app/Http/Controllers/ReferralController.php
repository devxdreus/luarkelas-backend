<?php

namespace App\Http\Controllers;

use App\Models\User;

class ReferralController extends Controller
{
    public function generate(\Request $request, User $user)
    {
        if ($request->user()->user_id != $user->user_id){
            return response('Unauthorized.', 401);
        }

        do {
            $code = str()->upper(str()->random(6));
        } while (User::where('referral_code', $code)->exists());

        $user->referral_code = $code;
        $user->save();

        return response()->json([
            "status" => true,
            "message" => "Referral Code Generated",
            "data" => [
                'referral_code' => $code,
            ],
        ]);
    }
}
