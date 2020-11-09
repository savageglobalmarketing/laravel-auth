<?php

namespace Maxcelos\Auth\Models;

use Dyrynda\Database\Casts\EfficientUuid;
use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Laravel\Scout\Searchable;
use Maxcelos\Auth\Database\Factories\UserFactory;
use Maxcelos\Auth\Notifications\VerifyEmail;
use Maxcelos\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use GeneratesUuid;
    use SoftDeletes;
    use Searchable;
    use HasApiTokens;
    use Notifiable;
    use HasRoles;
    use HasFactory;

    protected $fillable = ['name', 'email', 'password', 'avatar'];

    protected $dates = ['deleted_at'];

    protected $hidden = [
        'password', 'remember_token'
    ];

    protected $casts = [
        'uuid' => EfficientUuid::class,
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    protected static function newFactory()
    {
        return UserFactory::new();
    }
}
