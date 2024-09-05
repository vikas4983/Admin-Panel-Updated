<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class DestroyButtonComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public $destroyRoute;
    public $id;
    public $name;
    public function __construct($destroyRoute, $id,$name)
    {
        $this->destroyRoute = $destroyRoute;
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.destroy-button-component');
    }
}
