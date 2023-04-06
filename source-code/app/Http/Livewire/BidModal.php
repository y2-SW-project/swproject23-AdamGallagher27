<?php

namespace App\Http\Livewire;

use Livewire\Component;

class BidModal extends Component
{

    public $show = false;
    public $guitar_id;
    public $user_id;

    protected $listeners = [
        'show' => 'show'
    ];
    

    public function show() {
        $this->show = !$this->show;
    }
    
    public function render()
    {
        return view('livewire.bid-modal');
    }
}
