<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CreateButtonComponent extends Component
{
    /**
     * Create a new component instance.
     */

    public $createRoute;
    public $countAll;
    public $active;
    public $inActive;
    public $activeRoute;
    public $inActiveRoute;
    public $deleteAllRoute;


    public function __construct($createRoute, $active, $inActive, $countAll,  $activeRoute, $inActiveRoute, $deleteAllRoute)
    {
        $this->createRoute = $createRoute;
        $this->countAll = $countAll;
        $this->deleteAllRoute = $deleteAllRoute;
        $this->active = $active;
        $this->inActive = $inActive;
        $this->activeRoute = $activeRoute;
        $this->inActiveRoute = $inActiveRoute;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.create-button-component');
    }
}
