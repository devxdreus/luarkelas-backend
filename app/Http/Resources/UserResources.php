<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "user_id" => $this->user_id,
            "google_id" => $this->google_id,
            "email" => $this->email,
            "image" => $this->image == null ? null : ($this->google_id != null ? $this->image : url("images/" . $this->image)),
            "student" => $this->whenLoaded("student"),
            "teacher" => $this->whenLoaded("teacher"),
        ];
    }
}