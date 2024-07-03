<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResources extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "user_id" => $this->user_id,
            "google_id" => $this->google_id,
            "role_id" => $this->role_id,
            "email" => $this->email,
            "referral_code" => $this->referral_code,
            "image" => $this->image == null ? null : ($this->google_id != null ? $this->image : url("images/" . $this->image)),
            "student" => $this->whenLoaded("student"),
            "teacher" => $this->whenLoaded("teacher"),
            "role" => $this->whenLoaded("role"),
            "referredBy" => $this->whenLoaded("referred"),
            "referrals" => $this->load('referrals.referred')->referrals->map(function ($ref) {
                return $ref->referred;
            }),
        ];
    }
}
