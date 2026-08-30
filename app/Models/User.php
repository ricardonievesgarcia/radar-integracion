<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\UserStatus;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, HasRoles;

    protected string $guard_name = 'web';

    protected $fillable = [
        'name',
        'email',
        'password',
        'estado',
        'ultimo_login_at',
        'ultimo_login_ip',
        'password_changed_at',
        'must_change_password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'estado' => UserStatus::class,
            'ultimo_login_at' => 'datetime',
            'password_changed_at' => 'datetime',
            'must_change_password' => 'boolean',
        ];
    }

    public function sessions(): HasMany
    {
        return $this->hasMany(UserSession::class);
    }
}
