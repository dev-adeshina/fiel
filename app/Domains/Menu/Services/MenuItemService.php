<?php 

namespace App\Domains\Menu\Services;

use Illuminate\Support\Str;
use App\Domains\Menu\Models\MenuItem;
use App\Domains\Menu\Repositories\MenuItemRepository;

class MenuItemService 
{
    public function __construct(
        protected MenuItemRepository $items
    ) {}

    public function create(array $data): MenuItem
    {
        $data['uuid'] = Str::uuid();

        $data['slug'] = Str::slug(
            $data['name'] . '-' . Str::random(5)
        );

        $data['sku'] = strtoupper(
            'MENU-' . Str::random(8)
        );

        return $this->items->create($data);
    }

    public function update(MenuItem $item, array $data): MenuItem
    {
        if (isset($data['name'])) {

            $data['slug'] = Str::slug(
                $data['name'] . '-' . Str::random(5)
            );
        }

        return $this->items->update($item, $data);
    }

    public function markAsFeatured(MenuItem $item): bool
    {
        return $item->update([
            'is_featured' => true,
        ]);
    }

    public function markAsUnavailable(MenuItem $item): bool
    {
        return $item->update([
            'is_available' => false,
        ]);
    }

    public function markAsAvailable(MenuItem $item): bool
    {
        return $item->update([
            'is_available' => true,
        ]);
    }

    public function delete(MenuItem $item): bool
    {
        return $this->items->delete($item);
    }

}