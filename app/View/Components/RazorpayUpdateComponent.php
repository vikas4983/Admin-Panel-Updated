<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class RazorpayUpdateComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public $paymentGateway;
    public function __construct($paymentGateway)
    {
        $this->paymentGateway = $paymentGateway;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.razorpay-update-component');
    }
}
