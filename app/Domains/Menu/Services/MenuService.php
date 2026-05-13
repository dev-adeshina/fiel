<?php 

namespace App\Domains\Menu\Services;

use Illuminate\Support\Str;
use App\Domains\Menu\Models\Menu;
use App\Domains\Menu\Repositories\MenuRepository;

class MenuService 
{
    public function __construct(
        protected MenuRepository $menus
    ) {}

    public function create(array $data): Menu
    {
        $data['uuid'] = Str::uuid();

        $data['slug'] = Str::slug($data['name']);

        return $this->menus->create($data);
    }

    public function update(Menu $menu, array $data): Menu
    {
        if (isset($data['name'])) {

            $data['slug'] = Str::slug($data['name']);
        }

        return $this->menus->update($menu, $data);
    }

    public function activate(Menu $menu): bool
    {
        return $menu->update([
            'is_active' => true,
        ]);
    }

    public function deactivate(Menu $menu): bool
    {
        return $menu->update([
            'is_active' => false,
        ]);
    }

    public function delete(Menu $menu): bool
    {
        return $this->menus->delete($menu);
    }
 
}