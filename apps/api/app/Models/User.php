<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\hasOneThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use Notifiable;

    protected $with = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'email',
        'password',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'roles'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    protected $appends = ['role', 'permissions'];

    /**
     * Summary of roles
     * @return hasOneThrough<Role, UserRole, User>
     */
    public function roles(): HasOneThrough
    {
        return $this->hasOneThrough(
            Role::class,
            UserRole::class,
            'user_id',
            'id',
            'id',
            'role_id'
        );
    }

    /**
     * Get the users role name.
     *
     * @return string|null
     */
    public function getRoleAttribute(): ?string
    {
        return $this->roles?->name;
    }

    /**
     * Get the users permissions.
     *
     * @return array
     */
    public function getPermissionsAttribute(): array
    {
        return $this->roles?->permissions->pluck('name')->toArray() ?? [];
    }

}
