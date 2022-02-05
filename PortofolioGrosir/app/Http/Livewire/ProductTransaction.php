<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ProductTransaction as ModelsProductTransaction;

class ProductTransaction extends Component
{

    public function render()
    {
        $this->products = ModelsProductTransaction::with('product')->get();
        return view('livewire.product-transaction');
    }
}
