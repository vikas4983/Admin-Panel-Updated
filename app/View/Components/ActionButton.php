<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ActionButton extends Component
{
    /**
     * Create a new component instance.
     */
    // public $destroy;
    // public $edit;
    // public $country;


    // public function __construct($destroy, $edit, $country)
    // {
    //     $this->destroy = $destroy;
    //     $this->edit = $edit;
    //     $this->country = $country;
    // }
    public $editRoute;
    public $destroyRoute;
    public $id;
    public $entityType;


    public function __construct($editRoute, $destroyRoute, $id, $entityType,)
    {
        $this->editRoute = $editRoute;
        $this->destroyRoute = $destroyRoute;
        $this->id = $id;
        $this->entityType = $entityType;
    }



    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.action-button');
    }
}
