<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportResources extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "report_id" => $this->report_id,
            "student_id" => $this->student_id,
            "teacher_id" => $this->teacher_id,
            "title" => $this->title,
            "content" => $this->content,
            "duration" => $this->duration,
            "student" => $this->whenLoaded("student"),
            "teacher" => $this->whenLoaded("teacher"),
            "created_at" => date("d-m-Y", strtotime($this->created_at)),
            "updated_at" => date("d-m-Y", strtotime($this->updated_at)),
            "deleted_at" => $this->deleted_at ? date("d-m-Y", strtotime($this->deleted_at)) : null,
        ];
    }
}