<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class EditActionButtonComponent extends Component
{
    public $editRoute;
    public $id;

    public function __construct($editRoute, $id)
    {
        $this->editRoute = $editRoute;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.edit-action-button-component');
    }
}
