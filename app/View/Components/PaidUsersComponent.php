<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class PaidUsersComponent extends Component
{
    /**
     * Create a new component instance.
     */

     public $paidUsers;
     public $profilePrefixs;
    public function __construct($paidUsers,$profilePrefixs)
    {
        $this->paidUsers = $paidUsers;
        $this->profilePrefixs = $profilePrefixs;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.paid-users-component');
    }
}
