<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nik',
        'division_id',
        'role',
        'name',
        'position',
        'email',
        'phone',
        'password',
        'image'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // mengisi remember_token ketika user baru dibuat
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($user){
            $user->remember_token = Str::random(10);
        });
    }

    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }


    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class, 'loan_user_id');
    }

    public function admin_loans(): HasMany
    {
        return $this->hasMany(Loan::class, 'admin_user_id');
    }
}