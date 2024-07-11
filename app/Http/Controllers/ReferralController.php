<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ReferralController extends Controller
{
    public function checkTokenExist(Request $request)
    {
        $token = $request->validate(['token' => 'required']);

        if (!$user = User::where('referral_code', $token)->first()){
            return response()->json([
                'status' => false,
                'message' => 'Kode referral tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Kode referral ditemukan',
            'data' => $user
        ]);
    }
}
