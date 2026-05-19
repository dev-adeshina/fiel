<?php

namespace App\Domains\Menu\Models;


use Database\Factories\MenuItemFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Domains\Menu\Services\MenuAvailabilityService;


class MenuItem extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'uuid',
        'menu_id',
        'menu_category_id',
        'name',
        'slug',
        'sku',
        'description',
        'short_description',
        'price',
        'compare_price',
        'cost_price',
        'image_path',
        'gallery',
        'calories',
        'preparation_time',
        'is_featured',
        'is_available',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'gallery' => 'array',
            'price' => 'decimal:2',
            'compare_price' => 'decimal:2',
            'cost_price' => 'decimal:2',
            'is_featured' => 'boolean',
            'is_available' => 'boolean',
        ];
    }

    protected $appends = ['currently_available',];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(MenuCategory::class, 'menu_category_id');
    }

    public function variants(): HasMany
    {
        return $this->hasMany(MenuItemVariant::class);
    }

    public function modifiers(): HasMany
    {
        return $this->hasMany(MenuItemModifier::class);
    }

    public function availabilities(): HasMany
    {
        return $this->hasMany(MenuItemAvailability::class);
    }

    public function getCurrentlyAvailableAttribute(): bool
    {
        return app(MenuAvailabilityService::class)->isAvailableNow($this);
    }

    protected static function newFactory(): MenuItemFactory
    {
        return MenuItemFactory::new();
    }

    

}
