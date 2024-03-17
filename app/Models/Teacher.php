<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "teachers";
    protected $primaryKey = "teacher_id";
    protected $fillable = [
        "user_id",
        'name',
        "address",
        "phone",
        "jobdesc",
        "age",
        "religion",
        'created_at',
        'updated_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id", "user_id");
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class, "teacher_id", "teacher_id");
    }

    public function reports(): HasMany
    {
        return $this->hasMany(Report::class, "teacher_id", "teacher_id");
    }
}