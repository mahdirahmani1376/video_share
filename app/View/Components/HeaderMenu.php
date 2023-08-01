<?php

namespace App\View\Components;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class HeaderMenu extends Component
{
    public function __construct(
        public Collection $categories
    )
    {
        $this->categories = Category::all();
    }

    public function render()
    {
        return view('components.header-menu');
    }
}
