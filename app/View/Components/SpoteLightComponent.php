<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class SpoteLightComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public $paidUser;
    public $profilePrefixs;
    public function __construct($paidUser, $profilePrefixs)
    {
        $this->paidUser = $paidUser;
        $this->profilePrefixs = $profilePrefixs;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.spote-light-component');
    }
}
