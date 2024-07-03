<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    protected $table = "users";
    protected $primaryKey = "user_id";
    protected $fillable = [
        "role_id",
        "google_id",
        'email',
        'password',
        "image",
        'referral_code',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function student(): HasOne
    {
        return $this->hasOne(Student::class, "user_id", "user_id");
    }

    public function teacher(): HasOne
    {
        return $this->hasOne(Teacher::class, "user_id", "user_id");
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, "role_id", "role_id");
    }

    public function referrals(): HasMany
    {
        return $this->hasMany(Referral::class, "referrer_id");
    }

    public function referred(): HasOne
    {
        return $this->hasOne(Referral::class, "referred_id");
    }

    public static function generateCode(): string
    {
        do {
            $code = "LK-" . str(str()->random(6))->upper();
        } while (User::where('referral_code', $code)->exists());

        return $code;
    }
}
