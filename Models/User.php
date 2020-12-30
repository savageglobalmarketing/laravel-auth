<?php

namespace SavageGlobalMarketing\Auth\Models;

use Dyrynda\Database\Casts\EfficientUuid;
use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Laravel\Scout\Searchable;
use SavageGlobalMarketing\Auth\Database\Factories\UserFactory;
use SavageGlobalMarketing\Auth\Notifications\VerifyEmail;
use SavageGlobalMarketing\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Hash;
use SavageGlobalMarketing\Auth\Traits\HasTenants;
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
    use HasTenants;

    protected $table = 'auth_users';

    protected $fillable = ['name', 'email', 'password', 'avatar', 'current_tenant_id'];

    protected $appends = [
         'current_tenant'
    ];

    protected $dates = ['deleted_at'];

    protected $hidden = [
        'password', 'remember_token'
    ];

    protected $casts = [
        'uuid' => EfficientUuid::class,
        'email_verified_at' => 'datetime',
    ];

    public function toSearchableArray()
    {
        $array = $this->toArray();

        unset($array['current_tenant']);
        unset($array['tenancies']);

        return $array;
    }

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
