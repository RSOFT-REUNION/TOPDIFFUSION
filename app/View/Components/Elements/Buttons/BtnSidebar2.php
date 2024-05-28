<?php

namespace App\View\Components\Elements\Buttons;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BtnSidebar2 extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $label,
        public $route,
        public $icon,
        public $class
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.elements.buttons.btn-sidebar2');
    }
}
