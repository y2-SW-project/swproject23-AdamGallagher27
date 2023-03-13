<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AccountData extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public object $userData
    )
    {}

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.account-data');
    }
}
