<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalCrud extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $routeView, public string $routeSubmit, public string $idButton, public bool $isMerged = true, public ?string $extraParams = null)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal-crud');
    }
}
