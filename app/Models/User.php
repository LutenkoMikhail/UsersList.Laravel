<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Config;
use Laravel\Sanctum\HasApiTokens;
use phpDocumentor\Reflection\Types\Collection;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [

        'name',
        'email',
        'password',
        'google_id',
        'role_id',
        'blocked',
        'email_verified_at',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [

        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'blocked' => 'boolean',
    ];

    /**
     * The model Role
     *
     * @var array<string, string>
     */
    protected $role;

    /**
     * Relationships Role Model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Relationships Photo Model
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function photo()
    {
        return $this->morphOne(Photo::class, 'photoable');
    }

    /**
     * Return not blocked all users
     * @return Collection Users
     */
    public function allUsersNotBlocked()
    {
        $this->role = new Role();
        return $this->select('name', 'email')->whereBlocked(false)->where('role_id', '=', $this->role->userRoleId())->get();
    }

    /**
     * Return all users
     * @return Collection Users
     */
    public function allUsers()
    {
        $this->role = new Role();
        return $this->where('role_id', '=', $this->role->userRoleId())->get();
    }
}
