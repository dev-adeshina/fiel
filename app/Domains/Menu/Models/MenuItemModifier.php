<?php

namespace App\Domains\Menu\Models;

use Database\Factories\MenuItemModifierFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MenuItemModifier extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'uuid',
        'menu_item_id',
        'name',
        'description',
        'price',
        'is_required',
        'max_selection',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'is_required' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function menuItem(): BelongsTo
    {
        return $this->belongsTo(MenuItem::class, 'menu_item_id');
    }

    protected static function newFactory(): MenuItemModifierFactory
    {
        return MenuItemModifierFactory::new();
    }
}
