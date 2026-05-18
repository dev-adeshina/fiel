<?php

namespace App\Domains\Auth\Models;

use App\Domains\Order\Models\Order;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<UserFactory> */
    use HasFactory;
    use HasApiTokens;
    use Notifiable; 
    use SoftDeletes;
    use HasRoles;


    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;


    protected string $guard_name = 'web';

    protected $fillable = [
        'uuid',
        'first_name',
        'last_name',
        'email',
        'phone',
        'password',
        'avatar',
        'status',
        'name'
    ];

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
            'last_login_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn () => trim("{$this->first_name} {$this->last_name}"),
            set: function ($value) {
                $parts = explode(' ', preg_replace('/\s+/', ' ', trim($value)), 2);
                
                return [
                    'first_name' => $parts[0] ?? '',
                    'last_name' => $parts[1] ?? '',
                ];
            }
        );
    }

    protected static function booted(): void
    {
        static::creating(function (User $user) {
            // Handle UUID generation
            if (empty($user->uuid)) {
                $user->uuid = (string) Str::uuid();
            }

            // Handle default status
            if (empty($user->status)) {
                $user->status = 'active';
            }
        });
    }
    
    
}
