<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class ForgotOTPCOmponent extends Component
{
    /**
     * Create a new component instance.
     */
    public $admin;
    public function __construct($admin)
    {
        $this->admin = $admin;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forgot-otp-component');
    }
}
