<?php

namespace App\View\Components\Elements\Inputs;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Textfield extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $name,
        public $label,
        public $type,
        public $placeholder,
        public $class,
        public $livewire,
        public $require
    )
    {

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.elements.inputs.textfield');
    }
}
