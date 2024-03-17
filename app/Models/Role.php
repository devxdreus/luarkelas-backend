<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;
    protected $table = "roles";
    protected $primaryKey = "role_id";
    protected $fillable = [
        "role_name",
        "created_at",
        "updated_at",
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, "role_id", "role_id");
    }
}