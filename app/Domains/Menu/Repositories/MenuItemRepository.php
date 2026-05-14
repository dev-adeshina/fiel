<?php

namespace App\Domains\Menu\Repositories;

use App\Domains\Menu\Models\MenuItem;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

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

    public function paginate(
        int $perPage = 15
    ): LengthAwarePaginator {

        return MenuItem::query()

            ->with([
                'category',
                'variants',
                'modifiers',
            ])

            ->paginate($perPage);
    }

    public function findById(
        int $id
    ): ?MenuItem {

        return MenuItem::query()

            ->with([
                'category',
                'variants',
                'modifiers',
                'availabilities',
            ])

            ->find($id);
    }

    public function findBySlug(
        string $slug
    ): ?MenuItem {

        return MenuItem::query()

            ->with([
                'category',
                'variants',
                'modifiers',
                'availabilities',
            ])

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

    public function create(
        array $data
    ): MenuItem {

        return MenuItem::create($data);
    }

    public function update(
        MenuItem $item,
        array $data
    ): MenuItem {

        if (isset($data['name'])) {

            $data['slug'] = Str::slug(
                $data['name']
            );
        }

        $item->update($data);

        return $item->refresh();
    }

    public function delete(
        MenuItem $item
    ): bool {

        return $item->delete();
    }

    public function paginatePublic(

        int $perPage = 15

    ): LengthAwarePaginator {

        $cacheKey = 'public_menu_items_' . md5(request()->fullUrl());


        return Cache::remember(
            $cacheKey,
            now()->addMinutes(10),

            function () use ($perPage) {
                return MenuItem::query()

                    ->with([
                        'category',
                        'variants',
                        'modifiers',
                        'availabilities',
                    ])

                    ->where('is_available', true)

                    ->when(
                        request('search'),

                        fn($query, $search) =>

                        $query->where(function ($q)
                        use ($search) {

                            $q->where(
                                'name',
                                'like',
                                "%{$search}%"
                            )

                                ->orWhere(
                                    'description',
                                    'like',
                                    "%{$search}%"
                                );
                        })
                    )

                    ->when(
                        request('category'),

                        fn($query, $category) =>

                        $query->whereHas(
                            'category',

                            fn($q) =>
                            $q->where(
                                'slug',
                                $category
                            )
                        )
                    )

                    ->when(
                        request('min_price'),

                        fn($query, $min) =>
                        $query->where(
                            'price',
                            '>=',
                            $min
                        )
                    )

                    ->when(
                        request('max_price'),

                        fn($query, $max) =>
                        $query->where(
                            'price',
                            '<=',
                            $max
                        )
                    )

                    ->when(
                        request('sort'),

                        function ($query, $sort) {

                            match ($sort) {

                                'price_asc'
                                => $query->orderBy('price'),

                                'price_desc'
                                => $query->orderByDesc('price'),

                                'latest'
                                => $query->latest(),

                                default
                                => $query->latest(),
                            };
                        }
                    )

                    ->latest()

                    ->paginate($perPage);
            }
        );
    }
}
