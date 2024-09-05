<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class DestroyActionButtonComponent extends Component
{
    
    public $destroyRoute;
    public $id;

    public function __construct($destroyRoute, $id)
    {
        $this->destroyRoute = $destroyRoute;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.destroy-action-button-component');
    }
}
