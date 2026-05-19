<?php

namespace App\Domains\Menu\Models;

use Database\Factories\MenuItemVariantFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class MenuItemVariant extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'menu_item_id',
        'description',
        'day_of_week',
        'start_time',
        'end_time',
        'is_available',
    ];

    protected function casts(): array
    {
        return [
            'is_available' => 'boolean',
        ];
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(MenuItem::class, 'menu_item_id');
    }

    protected static function newFactory(): MenuItemVariantFactory
    {
        return MenuItemVariantFactory::new();
    }

    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class);
    }

    
}
