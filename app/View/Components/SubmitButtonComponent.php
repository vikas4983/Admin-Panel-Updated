<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SubmitButtonComponent extends Component
{
    /**
     * Create a new component instance.
     */
     public $buttonStyle;
     public $content;


    public function __construct($buttonStyle, $content,)
    {
        $this->buttonStyle = $buttonStyle;
        $this->content = $content;
       
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.submit-button-component');
    }
}
