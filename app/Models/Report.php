<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "reports";
    protected $primaryKey = "report_id";
    protected $fillable = [
        "student_id",
        "teacher_id",
        "title",
        "content",
        "duration",
        "created_at",
        "updated_at",
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, "student_id", "student_id");
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class, "teacher_id", "teacher_id");
    }
}