<?php

namespace App\Http\Livewire;

use Livewire\Component;

class StatusOrder extends Component
{

    public $order, $status;

    public function mount(){
        $this->status = $this->order->status;
    }

    public function update(){
        $this->order->status = $this->status;
        $this->order->save();
    }

    public function render()
    {

        $items = json_decode($this->order->content);
        $shipping = json_decode($this->order->shipping);

        return view('livewire.status-order', compact('items', 'shipping'));
    }
}