<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Role extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Relationships User Model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Return id Role
     * @param string $constantRole
     * @return int id Role
     */
    public function roleID(string $constantRole): int
    {
        $roleID=$this->where('name', '=', $constantRole)->first();
        return $roleID->id;
    }

    /**
     * Return id Role User
     * @return int id User Role
     */
    public function userRoleId(): int
    {
        return $this->roleID(Config::get('constants.db.roles.user'));
    }

    /**
     * Return id Role Admin
     * @return int id Admin Role
     */
    public function adminRoleId(): int
    {
        return $this->roleID(Config::get('constants.db.roles.admin'));
    }
}
