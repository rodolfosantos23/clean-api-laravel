<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Validator;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public static $validations = [
        'name' => 'required|min:3|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
        'password' => 'hashed',
    ];

    public function setNameAttribute($value)
    {
        $isNameInvalid = Validator::make(['name' => $value], [
            'name' => self::$validations['name'],
        ])->fails();

        if ($isNameInvalid) {
            throw new \Exception('Name must have at least 3 characters');
        }

        $this->attributes['name'] = ucfirst($value);
    }

    public function setEmailAttribute($value)
    {
        $isEmailInvalid = Validator::make(['email' => $value], [
            'email' => self::$validations['email'],
        ])->fails();

        if ($isEmailInvalid) {
            throw new \Exception('Invalid email address');
        }
        $this->attributes['email'] = strtolower($value);
    }

    public function setPasswordAttribute($value)
    {
        $isPasswordInvalid = Validator::make(['password' => $value], [
            'password' => self::$validations['password'],
        ])->fails();

        if ($isPasswordInvalid) {
            throw new \Exception('Password must have at least 6 characters');
        }
        $this->attributes['password'] = bcrypt($value);
    }
}
