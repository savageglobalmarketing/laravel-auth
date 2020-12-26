<?php

namespace SavageGlobalMarketing\Auth\Models;

use Dyrynda\Database\Casts\EfficientUuid;
use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use SavageGlobalMarketing\Auth\Database\Factories\TenantFactory;
use Wildside\Userstamps\Userstamps;

class Tenant extends Model
{
    use GeneratesUuid;
    use SoftDeletes;
    use Searchable;
    use Userstamps;
    use HasFactory;

    protected $table = 'auth_tenants';

    protected $fillable = ['name', 'owner_id'];

    protected $casts = [
        'uuid' => EfficientUuid::class,
    ];

    protected static function newFactory()
    {
        return TenantFactory::new();
    }
}
