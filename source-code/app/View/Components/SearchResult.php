<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SearchResult extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        // defines the props for component
        public string $searchKey,
        public string $numResults
    ){}

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.search-result');
    }
}
