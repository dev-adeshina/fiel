<?php 

namespace App\Domains\Menu\Repositories;

use App\Domains\Menu\Models\MenuItem;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;



class MenuItemRepository 
{
    public function all(): Collection
    {
        return MenuItem::query()
            ->with([
                'category',
                'variants',
                'modifiers',
            ])
            ->get();
    }

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return MenuItem::query()
            ->with([
                'category',
                'variants',
                'modifiers',
            ])
            ->paginate($perPage);
    }

    public function findById(int $id): ?MenuItem
    {
        return MenuItem::query()
            ->with([
                'category',
                'variants',
                'modifiers',
                'availabilities',
            ])
            ->find($id);
    }

    public function findBySlug(string $slug): ?MenuItem
    {
        return MenuItem::query()
            ->where('slug', $slug)
            ->first();
    }

    public function featured(): Collection
    {
        return MenuItem::query()
            ->where('is_featured', true)
            ->where('is_available', true)
            ->get();
    }

    public function available(): Collection
    {
        return MenuItem::query()
            ->where('is_available', true)
            ->get();
    }

    public function create(array $data): MenuItem
    {
        return MenuItem::create($data);
    }

    public function update(MenuItem $item, array $data): MenuItem
    {
        // return $item->update($data);

        if (isset($data['name'])) {

            $data['slug'] = Str::slug($data['name']);
        }

        $item->update($data);

        return $item->refresh();
    }

    public function delete(MenuItem $item): bool
    {
        return $item->delete();
    }
}