<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Filter extends Component
{
    public $locations;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($locations = [])
    {
        $this->locations = $locations;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.filter');
    }
}
