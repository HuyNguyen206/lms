<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;
use Illuminate\View\View;

class BaseLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('admin.layouts.base');
    }
}
