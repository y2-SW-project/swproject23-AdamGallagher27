<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SearchCard extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        // defines the props for component
        public string $price,
        public string $userName
    ){}

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.search-card');
    }
}
