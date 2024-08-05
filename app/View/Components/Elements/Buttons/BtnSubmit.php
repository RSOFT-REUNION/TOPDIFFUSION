<?php

namespace App\View\Components\Elements\Buttons;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BtnSubmit extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $label,
        public $class,
        public $icon
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.elements.buttons.btn-submit');
    }
}
