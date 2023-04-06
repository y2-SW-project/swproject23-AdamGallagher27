<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ProfileTabs extends Component
{

    public $products;
    public $likes;
    public $show = true;

    protected $listeners = [
        'show' => 'show',
    ];

    public function show() {
        $this->show = !$this->show;
    }

    public function render()
    {
        return view('livewire.profile-tabs');
    }
}
