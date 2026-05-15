<?php

namespace App\Domains\Order\Models;

use App\Domains\Auth\Models\User;
use App\Domains\Order\Enums\OrderStatus;
use App\Domains\Order\Enums\PaymentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Domains\Order\Models\OrderItem;
use App\Domains\Payment\Models\Payment;
use Illuminate\Database\Eloquent\SoftDeletes;



class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [

        'uuid',

        'user_id',

        'order_number',

        'type',

        'status',

        'customer_name',

        'customer_email',

        'customer_phone',

        'delivery_address',

        'notes',

        'subtotal',

        'tax',

        'delivery_fee',

        'discount',

        'total',

        'payment_status',

        'payment_method',

        'placed_at',

        'confirmed_at',

        'completed_at',
    ];


    protected function casts(): array
    {
        return [

            'status'
                => OrderStatus::class,

            'payment_status'
                => PaymentStatus::class,

            'placed_at'
                => 'datetime',

            'confirmed_at'
                => 'datetime',

            'completed_at'
                => 'datetime',
                
            'preparation_started_at'
                => 'datetime',

            'ready_at'
                => 'datetime',
        ];
    }

   

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
