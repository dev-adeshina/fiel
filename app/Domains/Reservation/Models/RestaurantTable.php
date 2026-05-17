<?php

namespace App\Domains\Reservation\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;



class RestaurantTable extends Model
{
    protected $fillable = [

        'name',

        'capacity',

        'is_active',
    ];

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}
