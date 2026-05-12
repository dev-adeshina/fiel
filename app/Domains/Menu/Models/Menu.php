<?php

namespace App\Domains\Menu\Models;

use Database\Factories\MenuFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;


class Menu extends Model
{
    use SoftDeletes;
    use HasFactory;
    
     protected $fillable = [
        'uuid',
        'name',
        'slug',
        'description',
        'is_active',
        'start_date',
        'end_date',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'start_date' => 'datetime',
            'end_date' => 'datetime',
        ];
    }

    public function categories(): HasMany
    {
        return $this->hasMany(MenuCategory::class);
    }

    protected static function newFactory(): MenuFactory
    {
        return MenuFactory::new();
    }
}
