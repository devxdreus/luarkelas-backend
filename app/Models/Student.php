<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "students";
    protected $primaryKey = "student_id";
    protected $fillable = [
        "user_id",
        "teacher_id",
        'name',
        "parentname",
        "nickname",
        "birthdate",
        "birthplace",
        "schoolname",
        "address",
        "phone",
        "grade",
        "age",
        "religion",
        "status",
        'created_at',
        'updated_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id", "user_id");
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class, "teacher_id", "teacher_id");
    }

    public function reports(): HasMany
    {
        return $this->hasMany(Report::class, "student_id", "student_id");
    }
}
