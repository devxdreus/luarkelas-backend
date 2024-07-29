<?php

namespace App\Http\Resources;

use App\Http\Resources\UserResources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResources extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "student_id" => $this->student_id,
            "user_id" => $this->user_id,
            "name" => $this->name,
            "parentname" => $this->parentname,
            "nickname" => $this->nickname,
            "birthdate" => $this->birthdate,
            "birthplace" => $this->birthplace,
            "schoolname" => $this->schoolname,
            "grade" => $this->grade,
            "address" => $this->address,
            "phone" => $this->phone,
            "age" => $this->age,
            "religion" => $this->religion,
            "status" => $this->status,
            "user" => new UserResources($this->whenLoaded("user")),
            "teacher" => $this->whenLoaded("teacher"),
            "reports" => $this->whenLoaded("reports"),
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
