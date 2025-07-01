<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * رابطه با نوع کاربر
     */
    public function userType()
    {
        return $this->belongsTo(UserType::class);
    }

    /**
     * رابطه با برندهایی که کاربر مالک آنهاست
     */
    public function ownedBrands()
    {
        return $this->hasMany(Brand::class, 'owner_id');
    }

    /**
     * بررسی اینکه آیا کاربر مدیر است
     */
    public function isAdmin()
    {
        return $this->userType && $this->userType->name === 'admin';
    }

    /**
     * بررسی اینکه آیا کاربر کارمند است
     */
    public function isStaff()
    {
        return $this->userType && $this->userType->name === 'staff';
    }
}
