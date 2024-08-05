<?php

namespace App\View\Components\Templates;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HeaderPopup extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $label,
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
        return view('components.templates.header-popup');
    }
}
