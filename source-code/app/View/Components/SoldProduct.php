<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SoldProduct extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public object $guitar,
        public object $type,
        public object $condition,
        public object $user,
        public string $current,
    )
    {
        
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sold-product');
    }
}
