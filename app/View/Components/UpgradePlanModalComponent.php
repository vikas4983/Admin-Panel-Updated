<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class UpgradePlanComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public $activeUser;
    public function __construct($activeUser)
    {
        $this->activeUser = $activeUser;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.upgrade-plan-component');
    }
}
