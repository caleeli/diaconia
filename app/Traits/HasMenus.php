<?php

namespace App\Traits;

use App\Menu;
use Illuminate\Database\Eloquent\Collection;

/**
 * @property \App\Menu[] $menu
 */
trait HasMenus
{

    /**
     * Return all the menues loaded
     *
     * @return Collection
     */
    public function allMenus()
    {
        return $this->roleObject->menus;
    }
}
