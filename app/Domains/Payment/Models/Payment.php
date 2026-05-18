<?php

namespace App\Domains\Payment\Models;

use App\Domains\Order\Models\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;


class Payment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'uuid',

        'order_id',

        'provider',

        'reference',

        'transaction_id',

        'amount',

        'currency',

        'status',

        'paid_at',

        'provider_response',
    ];


    protected function casts(): array
    {
        return [

            'provider_response'
                => 'array',

            'paid_at'
                => 'datetime',
        ];
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(
            Order::class
        );
    }
}
