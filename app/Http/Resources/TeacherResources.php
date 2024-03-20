<?php

namespace App\Http\Resources;

use App\Http\Resources\StudentResources;
use App\Http\Resources\UserResources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherResources extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "teacher_id" => $this->teacher_id,
            "user_id" => $this->user_id,
            "name" => $this->name,
            "address" => $this->address,
            "phone" => $this->phone,
            "age" => $this->age,
            "religion" => $this->religion,
            "jobdesc" => $this->jobdesc,
            "user" => new UserResources($this->whenLoaded("user")),
            "students" => StudentResources::collection($this->whenLoaded("students")),
            // "students" => $this->whenLoaded("students"),
            "reports" => $this->whenLoaded("reports"),
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "deleted_at" => $this->deleted_at ? date("d-m-Y", strtotime($this->deleted_at)) : null,
        ];
    }
}
