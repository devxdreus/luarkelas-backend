<?php

namespace App\Http\Controllers;

use App\Models\Referral;
use App\Models\User;

class ReferralController extends Controller
{
    public function generate(\Request $request, User $user)
    {
        if ($request->user()->user_id != $user->user_id){
            return response('Unauthorized.', 401);
        }

        $user->referral_code = User::generateCode();
        $user->save();

        return response()->json([
            "status" => true,
            "message" => "Referral Code Generated",
            "data" => [
                'referral_code' => $user->referral_code,
            ],
        ]);
    }
}
