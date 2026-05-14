<?php

namespace App\Domains\Menu\Models;

use Database\Factories\MenuItemAvailabilityFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class MenuItemAvailability extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'uuid',
        'menu_item_id',
        'name',
        'description',
        'sku',
        'price',
        'price_adjustment',
        'is_default',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'price_adjustment' => 'decimal:2',
            'is_default' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(MenuItem::class, 'menu_item_id');
    }

    public function menuItem()
    {
        return $this->belongsTo(
            MenuItem::class
        );
    }

    protected static function newFactory(): MenuItemAvailabilityFactory
    {
        return MenuItemAvailabilityFactory::new();
    }
}
