<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class SpotLightUsersComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public $spotelights;
    public $profilePrefixs;
    public function __construct($spotelights, $profilePrefixs)
    {
        $this->spotelights = $spotelights;
        $this->profilePrefixs = $profilePrefixs;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.spot-light-users-component');
    }
}
