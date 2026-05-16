<?php

namespace App\Domains\Inventory\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class InventoryItem extends Model
{
    protected $fillable = [

        'uuid',

        'name',

        'sku',

        'quantity',

        'unit',

        'minimum_quantity',

        'cost_price',

        'is_active',
    ];

    protected static function booted(): void
    {
        static::creating(function ($item) {

            $item->uuid = Str::uuid();
        });
    }

    public function movements(): HasMany
    {
        return $this->hasMany(
            InventoryMovement::class
        );
    }
}
