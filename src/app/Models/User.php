<?php

namespace App\Models;

use App\Classes\auth\Encryptor;
use App\Classes\Message;
use App\Models\traits\Commons;
use App\Models\traits\user\Queries;
use App\Models\traits\user\Relations;
use App\Models\traits\user\Scopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'state',
        'grade',
        'job',
        'age',
        'international_code',
        'hashed_international_code',
        'password',
    ];
    use LaratrustUserTrait;

    use Relations, Queries, Commons, HasApiTokens, HasFactory, Notifiable, Scopes;

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

    /**
     * The returnable user attributes after login
     *
     * @return array
     */
    public function returnable($password = null)
    {
        return [
            'id' => $this->id,
            'name' => $this->fullName(),
            'email' => $this->email,
            'token' => r('password') ?? $password,
            'international_code' => $this->international_code,
            'permissions' => Auth::user()->loggedInUserPermissions(),
            'roles' => Auth::user()->loggedInUserRoles()
        ];
    }

    /**
     * Get user full name
     *
     * @return string
     */
    public function fullName(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Toggles user's activation
     */
    public function toggleActivation()
    {
        $this->is_active = !$this->is_active;
        $this->save();
    }
}
