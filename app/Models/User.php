<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    const ADMIN_ROLE   = 1;
    const CASHIER_ROLE = 2;

    const STATUS_ACTIVE   = 1;
    const STATUS_INACTIVE = 0;

    const ROLES = [
        self::ADMIN_ROLE => [
            'value' => self::ADMIN_ROLE,
            'label' => 'Admin'
        ],
        self::CASHIER_ROLE => [
            'value' => self::CASHIER_ROLE,
            'label' => 'Admin'
        ]
    ];

    const STATUS = [
        self::STATUS_ACTIVE => [
            'value' => self::STATUS_ACTIVE,
            'label' => 'Active'
        ],
        self::STATUS_INACTIVE => [
            'value' => self::STATUS_INACTIVE,
            'label' => 'Inactive'
        ]
    ];

    protected $table = 'users';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'updated_at',
    ];

    protected $guarded = [];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function routeNotificationForFcm()
    {
        return $this->fcm_token ? [$this->fcm_token] : null;
    }

    public function routeNotificationForMail($notification)
    {
        return $this->email;
    }

    public function role()
    {
        return $this->role_id;
    }
}
