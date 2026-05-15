<?php

namespace App\Domains\Order\Models;

use App\Domains\Menu\Models\MenuItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Domains\Order\Models\Order;

class OrderItem extends Model
{
    use HasFactory;


    protected $fillable = [
        'uuid',

        'order_id',

        'menu_item_id',

        'item_name',

        'variant_name',

        'modifier_names',

        'unit_price',

        'quantity',

        'total_price',

        'special_instructions',
    ];

    protected function casts(): array
    {
        return [

            'modifier_names'
                => 'array',
        ];
    }


    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    } 


    public function menuItem(): BelongsTo 
    {
        return $this->belongsTo(MenuItem::class);
    }
}
