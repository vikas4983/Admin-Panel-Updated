<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class EditSpoteLightModalComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public $paidUser;
    public function __construct($paidUser)
    {
        $this->paidUser= $paidUser;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.edit-spote-light-modal-component');
    }
}
