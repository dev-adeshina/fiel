<?php

namespace App\Domains\Reservation\Models;

use App\Domains\Auth\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;


class Reservation extends Model
{
    use SoftDeletes;
    protected $fillable = [

        'user_id',

        'restaurant_table_id',

        'guest_name',

        'guest_email',

        'guest_phone',

        'guest_count',

        'reservation_date',

        'reservation_time',

        'special_request',

        'status',
    ];

    protected $casts = ['reservation_date' => 'date',];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function table(): BelongsTo
    {
        return $this->belongsTo(RestaurantTable::class, 'restaurant_table_id');
    }
}
